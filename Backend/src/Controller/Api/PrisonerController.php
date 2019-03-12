<?php

namespace App\Controller\Api;

use App\Entity\Prisoner;
use App\Repository\CellRepository;
use App\Repository\PrisonerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class PrisonerController
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
     * @SerializerInterface $serializer
     */
    private $serializer;

    /**
     * @param EntityManagerInterface $entityManager
     * @param PrisonerRepository     $prisonerRepository
     * @param SerializerInterface    $serializer
     */
    public function __construct(EntityManagerInterface $entityManager, PrisonerRepository $prisonerRepository, SerializerInterface $serializer) //to jest wstrzykiwanie zaleznosci
    {
        $this->entityManager = $entityManager;
        $this->prisonerRepository = $prisonerRepository;
        $this->serializer = $serializer;
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
            return JsonResponse::create([
                "message" => "Lista została poprawnie pobrana",
                "prisoners" => $this->serializer->serialize($prisoners, 'json')
            ]);
        } catch (\Exception $e) {
            return JsonResponse::create([
                "message" => "Lista nie została pobrana, błąd: " . $e->getMessage()
            ]);
        }
    }

    /**
     * @Route(name="prisoner_register", methods={"POST"})
     * @param Request $request
     * @param CellRepository $cellRepository
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function register(Request $request, CellRepository $cellRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);
//            $cell = $cellRepository->findOneBy(["id"=>$data["cellId"]]);
            $prisoner = new Prisoner($data["firstName"], $data["lastName"], new \DateTime('now'), new \DateTime($data["dateOfBirth"]), $data["cellId"]);

            $entityManager->persist($prisoner);
            $entityManager->flush();
            return JsonResponse::create([
                "message" => "Więzień został zarejestrowany"
            ]);
        } catch (\Exception $e) {
            return JsonResponse::create([
                "message" => "Więzień nie został zarejestrowany, błąd: " . $e->getMessage()
            ]);
        }
    }

    /**
     * @Route("/{id}", name="prisoner_delete", methods={"DELETE"})
     * @param int $id
     * @param PrisonerRepository $prisonerRepository
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function delete(int $id, PrisonerRepository $prisonerRepository, EntityManagerInterface $entityManager)
    {
        try {
            $prisoner = $prisonerRepository->find($id);
            $entityManager->remove($prisoner);
            $entityManager->flush();
            return JsonResponse::create([
                "message" => "Więzień został poprawnie usunięty"
            ]);
        } catch (\Exception $e) {
            return JsonResponse::create([
                "message" => "Więzień nie został usunięty, błąd: " . $e->getMessage()
            ]);
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
            $prisoner = $this->prisonerRepository->findOneBy(["id"=>$id]);
            return JsonResponse::create($prisoner ? [
                "prisoner" => $this->serializer->serialize($prisoner, 'json')
            ]: ["message" => "Brak więźnia o id: {$id}"]);
        } catch (\Exception $e) {
            return JsonResponse::create([
                "message" => "Brak więźnia o id: ".$id.", błąd: " . $e->getMessage()
            ]);
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
            if(!$prisoner) return JsonResponse::create(["message" => "Brak więźnia o id: {$id}"]);
            if (array_key_exists("FirstName", $data)) $prisoner->setFirstName($data["FirstName"]);
            if (array_key_exists("LastName", $data)) $prisoner->setLastName($data["LastName"]);
            if (array_key_exists("CellId", $data)) $prisoner->setCellId($data["CellId"]);
            if (array_key_exists("DateOfBirth", $data)) $prisoner->setDateOfBirth(new \DateTime($data["DateOfBirth"]));
            $this->entityManager->flush();
            return JsonResponse::create([
                "message" => "Więzień o id {$id} został zaaktualizowany.",
                "data" => $data
            ]);
        } catch (\Exception $e) {
            return JsonResponse::create([
                "message" => "Brak więźnia lub wystąpił błąd: ". $e->getMessage()
            ]);
        }
    }
}