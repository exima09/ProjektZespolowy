<?php

namespace App\Controller\Api;

use App\Repository\CellRepository;
use App\Repository\PrisonerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager) //to jest wstrzykiwanie zaleznosci
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/list", name="prisoner_list")
     * @param PrisonerRepository $prisonerRepository
     * @return JsonResponse
     */
    public function list(PrisonerRepository $prisonerRepository): JsonResponse
    {
        try {
            $tableFromDatabase = $prisonerRepository->findAll();
            $table = [];
            foreach ($tableFromDatabase as $prisoner) {
                $table[] = [
                    "prisonerId" => $prisoner->getId(),
                    "firstName" => $prisoner->getFirstName(),
                    "lastName" => $prisoner->getLastName(),
                    "dateOfBirthday" => $prisoner->getDateOfBirdth(),
                    "joinDate" => $prisoner->getJoinDate(),
                    "cellId" => $prisoner->getCellId()
                ];
            }
            return JsonResponse::create([
                "message" => "Lista została poprawnie pobrana",
                "prisoners" => $table
            ]);
        } catch(\Exception $e) {
            return JsonResponse::create([
                "message" => "Lista nie została pobrana, błąd: ".$e->getMessage()
            ]);
        }
    }

    /**
     * @Route("/register", name="prisoner_register")
     * @param Request $request
     * @param CellRepository $cellRepository
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function register(Request $request, CellRepository $cellRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);
            $cell = $cellRepository->findOneBy(["id"=>$data["cellid"]]);
            $prisoner = new Prisoner($data["firstname"], $data["lastname"], $data["joindate"], $data["dateofbirth"], $cell);

            $entityManager->persist($prisoner);
            $entityManager->flush();
            return JsonResponse::create([
                "message" => "Więzień został zarejestrowany"
            ]);
        } catch(\Exception $e) {
            return JsonResponse::create([
                "message" => "Więzień nie został zarejestrowany, błąd: ".$e->getMessage()
            ]);
        }
    }

    /**
     * @Route("/delete/{id}", name="prisoner_delete")
     * @param int $id
     * @param PrisonerRepository $prisonerRepository
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function delete(int $id, PrisonerRepository $prisonerRepository, EntityManagerInterface $entityManager)
    {
        try
        {
            $prisoner = $prisonerRepository->find($id);
            $entityManager->remove($prisoner);
            $entityManager->flush();
            return JsonResponse::create([
                "message" => "Więzień został poprawnie usunięty"
            ]);
        } catch (\Exception $e) {
            return JsonResponse::create([
                "message" => "Więzień nie został usunięty, błąd: ".$e->getMessage()
            ]);
        }
    }
}