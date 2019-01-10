<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class JailController
 * @package App\Controller\Api
 * @Route("/api/jail")
 */
class JailController extends AbstractController
{

    /**
     * @EntityManagerInterface $entityManager
     */
    private $entityManager;
    /**
     * JailController constructor.
     */
    public function __construct(EntityManagerInterface $entityManager) //to jest wstrzykiwanie zaleznosci
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/list", name="jail_list")
     * @param UserRepository $userRepository
     * @return JsonResponse
     */
    public function index(UserRepository $userRepository): JsonResponse
    {
        $tableFromDatabase = $userRepository->findAll();
        $table = [];
        foreach ($tableFromDatabase as $user){
            $table[] = [
                "id" => $user->getId(),
                "username" => $user->getUsername(),
                "role" => $user->getRoles()
            ];
        }
        return JsonResponse::create([
            "message"=>"Sandra masz niespodzianke <3",
            "users"=>$table
        ]);
    }
}
