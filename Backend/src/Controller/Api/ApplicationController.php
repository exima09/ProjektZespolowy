<?php

namespace App\Controller\Api;

use App\Entity\Application;
use App\Repository\ApplicationRepository;
use App\Repository\ApplicationStatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class ApplicationController
 * @Route("/api/application")
 * @package App\Controller\Api
 */
class ApplicationController extends AbstractController
{
    /**
     * @EntityManagerInterface $entityManager
     */
    private $entityManager;

    /**
     * @SerializerInterface $serializer
     */
    private $serializer;

    /**
     * @ApplicationRepository $applicationRepository
     */
    private $applicationRepository;

    /**
     * @ApplicationStatusRepository $applicationStatusRepository
     */
    private $applicationStatusRepository;

    /**
     * ApplicationController constructor.
     * @param EntityManagerInterface $entityManager
     * @param SerializerInterface $serializer
     * @param ApplicationRepository $applicationRepository
     * @param ApplicationStatusRepository $applicationStatusRepository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        ApplicationRepository $applicationRepository,
        ApplicationStatusRepository $applicationStatusRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
        $this->applicationRepository = $applicationRepository;
        $this->applicationStatusRepository = $applicationStatusRepository;
    }

    /**
     * @Route(name="application_list" , methods={"GET"})
     * @return JsonResponse
     */
    public function list()
    {
        try {
            return new JsonResponse([
                "message" => "Lista została poprawnie pobrana",
                "applications" => $this->serializer->serialize($this->applicationRepository->findAll(), 'json', SerializationContext::create()->enableMaxDepthChecks())
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                "message" => "Lista nie została poprawnie pobrana",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @Route("/{id}",name="application_get" , methods={"GET"}, requirements={"id"="\d+"})
     * @param int $id
     * @return JsonResponse
     */
    public function getById(int $id)
    {
        try {
            $application = $this->applicationRepository->find($id);
            if(!$application){
                return new JsonResponse([
                    "message" => "Błąd podczas pobierania zgłoszenia",
                    "error" => "Brak zgłoszenia o numerze {$id}"
                ], 400);
            }
            return new JsonResponse([
                "message" => "Pobrano poprawnie zgłoszenie",
                "application" => $this->serializer->serialize($this->applicationRepository->find($id), 'json')
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                "message" => "Błąd podczas pobierania zgłoszenia",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @Route("/status", name="application_status_list" , methods={"GET"})
     * @return JsonResponse
     */
    public function status_list()
    {
        try {
            return new JsonResponse([
                "message" => "Lista została poprawnie pobrana",
                "applications" => $this->serializer->serialize($this->applicationStatusRepository->findAll(), 'json')
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                "message" => "Lista nie została poprawnie pobrana",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @Route("/{id}", name="application_change_status" , methods={"PATCH"}, requirements={"id"="\d+"})
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function change_status(int $id, Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);
            if (array_key_exists("statusId", $data)) {
                $application = $this->applicationRepository->find($id);
                if (!$application) {
                    return new JsonResponse([
                        "message" => "Brak podania o numerze {$id}",
                        "error" => "Brak podania o numerze {$id}"
                    ], 400);
                }

                $applicationStatus = $this->applicationStatusRepository->find($data['statusId']);
                if (!$applicationStatus) {
                    return new JsonResponse([
                        "message" => "Brak statusu podania o numerze {$data['statusId']}",
                        "error" => "Brak statusu podania o numerze {$data['statusId']}"
                    ], 400);
                }

                $application->setStatus($applicationStatus);
                $this->entityManager->flush();


                return new JsonResponse([
                    "message" => "Zmiana statusu podania przebiegła pomyślnie"
                ]);
            }

            return new JsonResponse([
                "message" => "Zmiana statusu podania nie przebiegła pomyślnie",
                "error" => "Brak statusId"
            ], 400);
        } catch (\Exception $e) {
            return new JsonResponse([
                "message" => "Zmiana statusu podania nie przebiegła pomyślnie",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @Route(name="application_add" , methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request)
    {
        try {
            $firstName = $request->request->get('firstName');
            $lastName = $request->request->get('lastName');
            $phoneNumber = $request->request->get('phoneNumber');
            $email = $request->request->get('email');
            if (
                !empty($firstName) &&
                !empty($lastName) &&
                !empty($phoneNumber) &&
                !empty($email)
            ) {
                $applicationStatus = $this->applicationStatusRepository->find(1);
                if (!$applicationStatus) {
                    return new JsonResponse([
                        "message" => "Brak podania o numerze 1",
                        "error" => "Brak podania o numerze 1"
                    ], 400);
                }
                $application = new Application();
                $application->setFirstName($firstName);
                $application->setLastName($lastName);
                $application->setPhoneNumber($phoneNumber);
                $application->setStatus($applicationStatus);
                $application->setEmail($email);


                /** @var UploadedFile $file */
                $file = $request->files->get('file');

                if (!$file) {
                    return new JsonResponse([
                        "message" => "Brak pliku",
                        "error" => "Brak pliku"
                    ], 400);
                }
                $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();

                try {

                    $file->move(
                        $this->getParameter('upload'),
                        $fileName
                    );
                } catch (FileException $e) {
                    return new JsonResponse([
                        "message" => "Błąd podczas ładowania pliku",
                        "error" => $e->getMessage()
                    ], 400);
                }

                $application->setFileUrl($fileName);


                $this->entityManager->persist($application);
                $this->entityManager->flush();

                return new JsonResponse([
                    "message" => "Podanie zostało złożone",
                    "link" => $request->server->get('HTTP_HOST').'/upload/'.$fileName
                ]);
            }

            return new JsonResponse([
                "message" => "Podanie nie zostało złożone poprawnie",
                "error" => "Sprawdz firstName lastName phoneNumber email file"
            ], 400);
        } catch (\Exception $e) {
            return new JsonResponse([
                "message" => "Podanie nie zostało złożone poprawnie",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}
