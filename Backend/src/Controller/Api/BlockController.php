<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\BlockRepository;
use App\Repository\CellRepository;
use App\Repository\PrisonerRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BlockController
 * @IsGranted(User::GUARD)
 * @Route("/api/block")
 * @package App\Controller\Api
 */
class BlockController extends AbstractController
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
     * @BlockRepository $blockRepository
     */
    private $blockRepository;

    /**
     * @CellRepository $blockRepository
     */
    private $cellRepository;

    /**
     * @PrisonerRepository $prisonerRepository
     */
    private $prisonerRepository;


    /**
     * BlockController constructor.
     * @param EntityManagerInterface $entityManager
     * @param SerializerInterface    $serializer
     * @param BlockRepository        $blockRepository
     * @param CellRepository         $cellRepository
     * @param PrisonerRepository     $prisonerRepository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        BlockRepository $blockRepository,
        CellRepository $cellRepository,
        PrisonerRepository $prisonerRepository
    ){
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
        $this->blockRepository = $blockRepository;
        $this->cellRepository = $cellRepository;
        $this->prisonerRepository = $prisonerRepository;
    }


    /**
     * @Route(name="block_list", methods={"GET"})
     * @return JsonResponse
     */
    public function list()
    {
        try {
            return new JsonResponse([
                "message" => "Lista została poprawnie pobrana",
                "blocks" => $this->serializer->serialize($this->blockRepository->findAll(), 'json')
            ]);
        } catch (Exception $e) {
            return new JsonResponse([
                "message" => "Lista nie została poprawnie pobrana",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @Route(name="block_add_prisoner_to_cell", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function addPrisonerToCell(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);

            if(array_key_exists("cellId", $data) &&
                array_key_exists("prisonerId", $data)
            ){
                $cell = $this->cellRepository->find($data["cellId"]);
                $prisoner = $this->prisonerRepository->find($data["prisonerId"]);
                if(!$cell) {
                    return new JsonResponse([
                        "message" => "Brak celi o numerze {$data["cellId"]}"
                    ], 400);
                }
                if(!$prisoner) {
                    return new JsonResponse([
                        "message" => "Brak więźnia o numerze {$data["prisonerId"]}"
                    ], 400);
                }
                $cell->setPrisoner($prisoner);
                $this->entityManager->flush();
                return new JsonResponse([
                    "message" => "Więzień został poprawnie przypisany do celi"
                ]);
            }
            return new JsonResponse([
                "message" => "Więzień nie został przypisany do celi",
                "error" => "Brak pól cellId lub prisonerId"
            ], 400);
        } catch (Exception $e) {
            return new JsonResponse([
                "message" => "Więzień nie został przypisany do celi",
                "error" => $e->getMessage()
            ], 400);
        }
    }
}
