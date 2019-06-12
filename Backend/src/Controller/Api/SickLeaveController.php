<?php

namespace App\Controller\Api;

use App\Entity\SickLeave;
use App\Entity\User;
use App\Repository\PrisonerRepository;
use App\Repository\SickLeaveRepository;
use App\Repository\WorkerRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SickLeaveController
 * @IsGranted(User::MEDICAL)
 * @Route("/api/sick-leave")
 * @package App\Controller\Api
 */
class SickLeaveController extends AbstractController
{
    /**
     * @EntityManagerInterface $entityManager
     */
    private $entityManager;

    /**
     * @SickLeaveRepository $sickLeaveRepository
     */
    private $sickLeaveRepository;

    /**
     * @SerializerInterface $serializer
     */
    private $serializer;

    /**
     * @PrisonerRepository $prisonerRepository
     */
    private $prisonerRepository;

    /**
     * @WorkerRepository $workerRepository
     */
    private $workerRepository;


    /**
     * SickLeaveController constructor.
     * @param EntityManagerInterface $entityManager
     * @param SickLeaveRepository    $sickLeaveRepository
     * @param SerializerInterface    $serializer
     * @param PrisonerRepository     $prisonerRepository
     * @param WorkerRepository       $workerRepository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        SickLeaveRepository $sickLeaveRepository,
        SerializerInterface $serializer,
        PrisonerRepository $prisonerRepository,
        WorkerRepository $workerRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->sickLeaveRepository = $sickLeaveRepository;
        $this->serializer = $serializer;
        $this->prisonerRepository = $prisonerRepository;
        $this->workerRepository = $workerRepository;
    }

    /**
     * @Route(name="sick_leave_list", methods={"GET"})
     * @return JsonResponse
     */
    function getAll()
    {
        try {
            $sickLeaves = $this->sickLeaveRepository->findAll();
            return new JsonResponse([
                "message" => "Lista została poprawnie pobrana",
                "sickLeaves" => $this->serializer->serialize($sickLeaves, 'json', SerializationContext::create()->enableMaxDepthChecks())
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                "message" => "Lista nie została poprawnie pobrana",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @Route(name="sick_leave_new", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    function create(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);
            if (
                array_key_exists("prisonerId", $data) &&
                array_key_exists("dateStart", $data) &&
                array_key_exists("dateStop", $data)
            ) {
                $prisoner = $this->prisonerRepository->find($data["prisonerId"]);
                if (!$prisoner) {
                    return new JsonResponse([
                        "message" => "Brak więźnia o numerze {$data["prisonerId"]}"
                    ], 400);
                }
                /** @var User $user */
                $user = $this->get('security.token_storage')->getToken()->getUser();
                if (!$user) {
                    return new JsonResponse([
                        "message" => "Brak zalogowanego użytkownika"
                    ], 400);
                }
                $worker = $this->workerRepository->find($user->getId());
                if (!$worker) {
                    return new JsonResponse([
                        "message" => "Brak pracownika o numerze {$user->getId()}"
                    ], 400);
                }

                if ((new \DateTime($data['dateStart']))->getTimestamp() > (new \DateTime($data['dateStop']))->getTimestamp()) {
                    return new JsonResponse([
                        "message" => "Sprawdź daty"
                    ], 400);
                }
                $sickLeave = new SickLeave($worker, $prisoner, new \DateTime($data['dateStart']), new \DateTime($data['dateStop']));
                if (array_key_exists("reason", $data)) {
                    $sickLeave->setReason($data["reason"]);
                }
                $this->entityManager->persist($sickLeave);
                $this->entityManager->flush();

                return new JsonResponse([
                    "message" => "Zwolnienie zostało poprawnie dodane"
                ]);
            } else {
                return new JsonResponse([
                    "message" => "Nie podałeś wszystkich pól"
                ], 400);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                "message" => "Zwolnienie nie zostało poprawnie dodane",
                "error" => $e->getMessage()
            ], 400);
        }
    }

}
