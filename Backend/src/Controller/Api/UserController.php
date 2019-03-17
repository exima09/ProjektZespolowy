<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserController
 * @Route("/api")
 * @package App\Controller\Api
 */
class UserController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     * @param EntityManagerInterface $entityManager
     * @param UserPasswordEncoderInterface $encoder
     * @return void
     */
    public function __construct(
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $encoder
    )
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->encoder = $encoder;
    }
    /**
     * @Route("/api", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    /**
     * @Route("/login", name="api_user_logIn")
     * @param Request $request
     * @return JsonResponse
     */
    public function logIn(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        var_dump($data);
        if ($this->userRepository->findBy(
            ['username' => $data['username']]
        )) {
            return JsonResponse::create(['error' => 'Username is exists']);
        } else {
            return JsonResponse::create(['error' => 'Username no exists']);
        }
    }

    /**
     * @Route("/register", name="api_user_register")
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if ($this->userRepository->findBy(
            ['username' => $data['username']]
        )) {
            return JsonResponse::create(['message' => 'Username is exists'], 400);
        } else {
            $user = new User();
            $user->setUsername($data['username']);
            $user->setRoles("ROLE_USER");
            $user->setPassword($this->encoder->encodePassword($user, $data['password']));
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return JsonResponse::create([
                'message' => "dodano"
            ]);
        }
    }
}
