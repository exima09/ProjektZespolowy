<?php

namespace App\Controller\Api;

use App\Entity\Execution;
use App\Repository\ExecutionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class ExecutionController
 * @Route("/api/execution")
 * @package App\Controller\Api
 */
class ExecutionController extends AbstractController
{
    /**
     * @EntityManagerInterface $entityManager
     */
    private $entityManager;

    /**
     * @ExecutionRepository $executionRepository
     */
    private $executionRepository;

    /**
     * @SerializerInterface $serializer
     */
    private $serializer;

    /**
     * @param EntityManagerInterface $entityManager
     * @param ExecutionRepository    $executionRepository
     * @param SerializerInterface    $serializer
     */
    public function __construct(EntityManagerInterface $entityManager, ExecutionRepository $executionRepository, SerializerInterface $serializer) //to jest wstrzykiwanie zaleznosci
    {
        $this->entityManager = $entityManager;
        $this->executionRepository = $executionRepository;
        $this->serializer = $serializer;
    }

    /**
     * @Route(name="execution_list", methods={"GET"})
     * @return JsonResponse
     */
    public function list()
    {
        try {
            return new JsonResponse([
                "message" => "Lista została poprawnie pobrana",
                "execution" => $this->serializer->serialize($this->executionRepository->findAll(), 'json')
            ]);
        } catch (Exception $e) {
            return new JsonResponse([
                "message" => "Lista nie została poprawnie pobrana",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @Route("/{id}",name="executions_get_by_id", methods={"GET"})
     * @param int $id
     * @return JsonResponse
     */
    public function getById(int $id)
    {
        try {
            $execution = $this->executionRepository->find($id);
            if($execution) {
                return new JsonResponse([
                    "visit" => $this->serializer->serialize($execution, 'json')
                ]);
            }
            return new JsonResponse(["message" => "Brak egzekucji o numerze: {$id}"], 400);
        } catch (Exception $e) {
            return new JsonResponse([
                "message" => "Wystąpił błąd podczas pobierania",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @Route("/get-date", name="execution_get_date_free", methods={"GET"})
     * @return JsonResponse
     * @throws \Exception
     */
    public function getDateFree()
    {
        try {
            $dateIsFree = false;
            $datePerWeek = strtotime('+7 day', strtotime('now'));
            do {
                /** @var string $tempExecution */
                $tempExecution = (new \DateTime())->setTimestamp($datePerWeek)->setTime(10, 0)->format("Y-m-d H:i:s");
                /** @var Execution[] $execution */
                $execution = $this->entityManager->createQuery('SELECT e FROM \App\Entity\Execution e WHERE e.ExecutionDate = :tempdate')->setParameter('tempdate', $tempExecution)->getResult();
                if (empty($execution)) {
                    $dateIsFree = true;
                    return new JsonResponse([
                        "message" => "Znaleziono najbliższą wolną datę za minimum tydzień.",
                        "ExecutionDate" => $this->serializer->serialize($tempExecution, 'json')
                    ]);
                }
                /** @var string $tempExecution */
                $tempExecution = (new \DateTime())->setTimestamp($datePerWeek)->setTime(14, 0)->format("Y-m-d H:i:s");
                /** @var Execution[] $execution */
                $execution = $this->entityManager->createQuery('SELECT e FROM \App\Entity\Execution e WHERE e.ExecutionDate = :tempdate')->setParameter('tempdate', $tempExecution)->getResult();
                if (empty($execution)) {
                    $dateIsFree = true;
                    return new JsonResponse([
                        "message" => "Znaleziono najbliższą wolną datę za minimum tydzień.",
                        "ExecutionDate" => $this->serializer->serialize($tempExecution, 'json')
                    ]);
                }
                $datePerWeek = strtotime('+1 day', $datePerWeek);
            } while (!$dateIsFree);
        } catch (Exception $e) {
            return new JsonResponse([
                "message" => "Najbliższa wolna data nie została znaleziona.",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @Route(name="execution_add", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function addExecution(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);
            /** @var string $tempExecution */
            $tempExecution = (new \DateTime($data["ExecutionDate"]))->format("Y-m-d H:i:s");
            /** @var Execution[] $execution */
            $execution = $this->entityManager->createQuery('SELECT e FROM \App\Entity\Execution e WHERE e.ExecutionDate = :tempdate')->setParameter('tempdate', $tempExecution)->getResult();
            if (empty($execution)) {
                if (
                    array_key_exists("ExecutionDate", $data) &&
                    array_key_exists("HasDone", $data) &&
                    array_key_exists("LastWishOrderId", $data) &&
                    array_key_exists("PrisonerId", $data) &&
                    array_key_exists("WorkerId", $data)) {
                    $newExecution = new Execution();
                    $newExecution->setExecutionDate(new \DateTime($data["ExecutionDate"]))
                        ->setHasDone($data["HasDone"])
                        ->setLastWishOrderId($data["LastWishOrderId"])
                        ->setPrisonerId($data["PrisonerId"])
                        ->setWorkerId($data["WorkerId"]);
                    $this->entityManager->persist($newExecution);
                    $this->entityManager->flush();
                    return new JsonResponse([
                        "message" => "Rezerwacja została złożona"
                    ]);
                } else {
                    return new JsonResponse([
                        "message" => "Wszystkie dane nie zostały wprowadzone!",
                        "error" => "Brakuje wszystkich pól"
                    ], 400);
                }
            } else {
                return new JsonResponse([
                    "message" => "Podana data jest już zajęta.",
                    "error" => "Podana data jest już zajęta."
                ], 400);
            }
        } catch (Exception $e) {
            return new JsonResponse([
                "message" => "Nie można złożyć rezerwacji na egzekucje.",
                "error" => $e->getMessage()
            ], 400);
        }
    }

}
