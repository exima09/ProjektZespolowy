<?php

namespace App\Controller\Api;

use App\Entity\Cell;
use App\Entity\Prisoner;
use App\Entity\User;
use App\Repository\CellRepository;
use App\Repository\PrisonerRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PrisonerController
 * @IsGranted(User::GUARD)
 * @Route("/api/prisoner")
 * @package App\Controller\Api
 */
class PrisonerController extends AbstractController
{
    /**
     * @EntityManagerInterface $entityManager
     */
    private $entityManager;

    /**
     * @PrisonerRepository $prisonerRepository
     */
    private $prisonerRepository;

    /**
     * @CellRepository $cellRepository
     */
    private $cellRepository;

    /**
     * @SerializerInterface $serializer
     */
    private $serializer;

    /**
     * @param EntityManagerInterface $entityManager
     * @param PrisonerRepository     $prisonerRepository
     * @param SerializerInterface    $serializer
     * @param CellRepository         $cellRepository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        PrisonerRepository $prisonerRepository,
        SerializerInterface $serializer,
        CellRepository $cellRepository
    ){
        $this->entityManager = $entityManager;
        $this->prisonerRepository = $prisonerRepository;
        $this->serializer = $serializer;
        $this->cellRepository = $cellRepository;
    }

    /**
     * @Route(name="prisoner_list", methods={"GET"})
     * @param PrisonerRepository $prisonerRepository
     * @return JsonResponse
     */
    public function list(PrisonerRepository $prisonerRepository): JsonResponse
    {
        try {
            $prisoners = $prisonerRepository->findAll();
            return new JsonResponse([
                "message" => "Lista została poprawnie pobrana",
                "prisoners" => $this->serializer->serialize($prisoners, 'json', SerializationContext::create()->enableMaxDepthChecks())
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                "message" => "Lista nie została pobrana",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @Route(name="prisoner_register", methods={"POST"})
     * @param Request                $request
     * @param CellRepository         $cellRepository
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function register(
        Request $request,
        CellRepository $cellRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        try {
            $data = json_decode($request->getContent(), true);
            $prisoner = new Prisoner($data["firstName"], $data["lastName"], new \DateTime('now'), new \DateTime($data["dateOfBirth"]));
            if(array_key_exists("cell", $data)){
                $cell = $cellRepository->findOneBy(["id"=>$data["cell"]]);
                if(!$cell){
                    return new JsonResponse([
                        "message" => "Więzień nie został zarejestrowany, Brak celi o numerze {$data['cell']}",
                        "error" => "Brak celi o numerze {$data['cell']}"
                    ], 400);
                }
                if($cell->getPrisoner()) {
                    return new JsonResponse([
                        "message" => "Więzień nie został zarejestrowany, Podana cela jest zajęta",
                        "error" => "Podana cela jest zajęta"
                    ], 400);
                } else {
                    $cell->setPrisoner($prisoner);
                }
            }

            $entityManager->persist($prisoner);
            $entityManager->flush();
            return new JsonResponse([
                "message" => "Więzień został zarejestrowany"
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                "message" => "Więzień nie został zarejestrowany",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @Route("/{id}", name="prisoner_delete", methods={"DELETE"})
     * @param int                    $id
     * @param PrisonerRepository     $prisonerRepository
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function delete(int $id, PrisonerRepository $prisonerRepository, EntityManagerInterface $entityManager)
    {
        try {
            $prisoner = $prisonerRepository->find($id);
            $entityManager->remove($prisoner);
            $entityManager->flush();
            return new JsonResponse([
                "message" => "Więzień został poprawnie usunięty"
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                "message" => "Więzień nie został usunięty",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @Route("/{id}", name="prisoner_getById", methods={"GET"})
     * @param int $id
     * @return JsonResponse
     */
    public function getPrisonerById(int $id)
    {
        try {
            $prisoner = $this->prisonerRepository->findOneBy(["id" => $id]);
            if($prisoner) {
                return JsonResponse::create([
                    "prisoner" => $this->serializer->serialize($prisoner, 'json')
                ]);
            }
            return JsonResponse::create(["message" => "Brak więźnia o id: {$id}"], 400);
        } catch (\Exception $e) {
            return JsonResponse::create([
                "message" => "Brak więźnia o id: {$id}",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @Route("/{id}", name="prisoner_update", methods={"PATCH"})
     * @param int     $id
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function updatePrisonerById(int $id, Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);
            $prisoner = $this->prisonerRepository->findOneBy(["id" => $id]);
            if (!$prisoner) return JsonResponse::create(["message" => "Brak więźnia o id: {$id}"], 400);
            if (array_key_exists("firstName", $data)) $prisoner->setFirstName($data["firstName"]);
            if (array_key_exists("lastName", $data)) $prisoner->setLastName($data["lastName"]);
            if (array_key_exists("cell", $data)) {
                /** @var Cell $cell */
                $cell = $this->cellRepository->find($data['cell']);
                if(!$cell){
                    return new JsonResponse([
                        "message" => "Więzień nie został zarejestrowany, Brak celi o numerze {$data['cell']}",
                        "error" => "Brak celi o numerze {$data['cell']}"
                    ], 400);
                }
                if(!$cell->getPrisoner() || $cell->getPrisoner() === $prisoner) {
                    $prisoner->getCell()->setPrisoner(null);
                    $cell->setPrisoner($prisoner);
                }
            }
            if (array_key_exists("dateOfBirth", $data)) $prisoner->setDateOfBirth(new \DateTime($data["dateOfBirth"]));
            $this->entityManager->flush();
            return JsonResponse::create([
                "message" => "Więzień o id {$id} został zaaktualizowany.",
                "data" => $data
            ]);
        } catch (\Exception $e) {
            return JsonResponse::create([
                "message" => "Brak więźnia lub wystąpił błąd",
                "error" => $e->getMessage()
            ], 400);
        }
    }
}