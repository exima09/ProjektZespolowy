<?php

namespace App\Controller\Api;

use App\Entity\Cell;
use App\Repository\CellRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use JMS\Serializer\SerializerInterface;

/**
 * Class CellController
 * @Route("/api/cell")
 * @package App\Controller\Api
 */
class CellController extends AbstractController
{
    /**
     * @Route("/list", name="cell_list")
     * @param CellRepository $cellRepository
     * @return JsonResponse
     */
    public function list(CellRepository $cellRepository): JsonResponse
    {
        $table = [];
        foreach ($cellRepository->findAll() as $cell) {
            $table[] = [
                "cellId" => $cell->getId()
            ];
        }
        return JsonResponse::create([
            "cells" => $table
        ], 400);
    }

    /**
     * @Route("/create", name="cell_create")
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function create(EntityManagerInterface $entityManager): JsonResponse
    {
        try {
            $cell = new Cell();
            $entityManager->persist($cell);
            $entityManager->flush();
            return JsonResponse::create([
                "message" => "Poprawnie dodano nową cele."
            ]);
        } catch (\Exception $e) {
            return JsonResponse::create([
                "message" => "Cela nie została dodana, błąd: ".$e->getMessage()
            ], 400);
        }
    }

    /**
     * @Route("/delete/{id}", name="cell_delete")
     * @param int $id
     * @param CellRepository $cellRepository
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function delete(int $id, CellRepository $cellRepository, EntityManagerInterface $entityManager)
    {
        try
        {
            $cell = $cellRepository->find($id);
            $entityManager->remove($cell);
            $entityManager->flush();
            return JsonResponse::create([
                "message" => "Cela została poprawnie usunięta"
            ]);
        } catch (\Exception $e) {
            return JsonResponse::create([
                "message" => "Cela nie została usunięta, błąd: ".$e->getMessage()
            ], 400);
        }
    }
}
