<?php

namespace App\Controller\Api;

use App\Entity\Visits;
use App\Repository\PrisonerRepository;
use App\Repository\VisitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use JMS\Serializer\SerializerInterface;

/**
 * Class VisitsController
 * @Route("/api/visits")
 * @package App\Controller\Api
 */
class VisitsController extends AbstractController
{
    /**
     * @var VisitsRepository $visitsRepository
     */
    private $visitsRepository;

    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;

    /**
     * @var PrisonerRepository $prisonerRepository;
     */
    private $prisonerRepository;

    /**
     * @var SerializerInterface $serializer
     */
    private $serializer;

    /**
     * VisitsController constructor.
     * @param VisitsRepository       $visitsRepository
     * @param EntityManagerInterface $entityManager
     * @param PrisonerRepository     $prisonerRepository
     * @param SerializerInterface    $serializer
     */
    public function __construct(VisitsRepository $visitsRepository, EntityManagerInterface $entityManager, PrisonerRepository $prisonerRepository, SerializerInterface $serializer)
    {
        $this->visitsRepository = $visitsRepository;
        $this->entityManager = $entityManager;
        $this->prisonerRepository = $prisonerRepository;
        $this->serializer = $serializer;
    }


    /**
     * @Route(name="visits_list", methods={"GET"})
     */
    public function list()
    {
        try {
            $visits = $this->visitsRepository->findBy([],['dateStart'=>'DESC']);
            return new JsonResponse([
                "message" => "Lista została poprawnie pobrana",
                "visits" => $this->serializer->serialize($visits, 'json', SerializationContext::create()->enableMaxDepthChecks())
            ]);
        } catch (Exception $e) {
            return new JsonResponse([
                "message" => "Lista nie została poprawnie pobrana",
                "error" => $e->getMessage()
            ], 400);
        }
    }


    /**
     * @Route("/{id}",name="visits_get_by_id", methods={"GET"})
     * @param int $id
     * @return JsonResponse
     */
    public function getById(int $id)
    {
        try {
            $visit = $this->visitsRepository->find($id);
            if($visit) {
                return new JsonResponse([
                    "visit" => $this->serializer->serialize($visit, 'json')
                ]);
            }
            return new JsonResponse(["message" => "Brak wizyty o numerze: {$id}"], 400);
        } catch (Exception $e) {
            return new JsonResponse([
                "message" => "Wystąpił błąd podczas pobierania",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @Route(name="visits_reservation", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function reservation(Request $request): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);
            /** @var string $contactType */
            $contactType = $data["contactType"];
            if(strcmp($contactType,Visits::TYPE_PHONE) != 0 && strcmp($contactType,Visits::TYPE_EMAIL) != 0)
            {
                return new JsonResponse([
                    "message" => "Nieprawidłowy typ kontaktu.",
                    "error" => "Invalid type. Please correct to P - phone or E - email"
                ], 400);
            }
            $dateStart = new \DateTime($data["dateStart"]);
            $dateStop = new \DateTime($data["dateStop"]);

            if($dateStop->getTimestamp() <= $dateStart->getTimestamp()){
                return new JsonResponse([
                    "message" => "Data rozpoczęcia jest później niż data zakończenia",
                    "error" => "Invalid dateStart or dateStop"
                ], 400);
            }

            $prisoner = $this->prisonerRepository->find($data["prisoner"]);
            if(!$prisoner){
                return new JsonResponse(["message" => "Brak więźnia o id: {$data["prisoner"]}"], 400);
            }

            $visit = new Visits($prisoner, $dateStart, $dateStop, $data["bookingPerson"], $contactType, $data["contact"]);

            $this->entityManager->persist($visit);
            $this->entityManager->flush();
            return new JsonResponse([
                "message" => "Rezerwacja została złożona pomyślnie"
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                "message" => "Wystąpił błąd podczas tworzenia rezerwacji",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @Route("/{id}", name="visits_delete", methods={"DELETE"})
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id)
    {
        try {
            $prisoner = $this->visitsRepository->find($id);
            if(!$prisoner){
                return new JsonResponse([
                    "message" => "Brak rezerwacji o numerze {$id}."
                ], 400);
            }
            $this->entityManager->remove($prisoner);
            $this->entityManager->flush();
            return new JsonResponse([
                "message" => "Rezerwacja wizyty została anulowana"
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                "message" => "Rezerwacja wizyty nie została anulowana",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @Route("/{id}", name="visits_update", methods={"PATCH"})
     * @param int     $id
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function updateVisitById(int $id, Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);
            $visit = $this->visitsRepository->findOneBy(["id" => $id]);
            if (!$visit) return new JsonResponse(["message" => "Brak rezerwacji o numerze: {$id}"], 400);
            if (array_key_exists("statusAccepted", $data)) $visit->setStatusAccepted($data["statusAccepted"]);
            $this->entityManager->flush();
            return new JsonResponse([
                "message" => "Rezerwacja o numerze {$id} została zaaktualizowana.",
                "data" => $data
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                "message" => "Brak więźnia o numerze {$id} lub wystąpił nieoczekiwany błąd",
                "error" => $e->getMessage()
            ], 400);
        }
    }
}
