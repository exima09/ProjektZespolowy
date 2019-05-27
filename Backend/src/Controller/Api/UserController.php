<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Entity\Worker;
use App\Repository\DepartmentRepository;
use App\Repository\UserRepository;
use App\Repository\WorkerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use JMS\Serializer\SerializerInterface;


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
     * @var WorkerRepository
     */
    private $workerRepository;
    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * @SerializerInterface $serializer
     */
    private $serializer;

    /**
     * UserController constructor.
     * @param UserRepository               $userRepository
     * @param EntityManagerInterface       $entityManager
     * @param UserPasswordEncoderInterface $encoder
     * @param SerializerInterface          $serializer
     * @param WorkerRepository             $workerRepository
     * @param DepartmentRepository         $departmentRepository
     */
    public function __construct(
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $encoder,
        SerializerInterface $serializer,
        WorkerRepository $workerRepository,
        DepartmentRepository $departmentRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->encoder = $encoder;
        $this->serializer = $serializer;
        $this->workerRepository = $workerRepository;
        $this->departmentRepository = $departmentRepository;
    }
    /**
     * @Route("/user", name="user_list", methods={"GET"})
     */
    public function list()
    {
        try {
            $users = $this->userRepository->findAll();
            return new JsonResponse([
                "users" => $this->serializer->serialize($users, 'json'),
                "message" => "Poprawnie pobrano liste użytkowników"
            ]);
        } catch (\Exception $exception) {
            return new JsonResponse([
                "message" => "Błąd podczas pobierania listy użytkowników",
                "error" => $exception->getMessage()
            ],400);
        }
    }

    /**
     * @Route("/worker", name="user_worker", methods={"GET"})
     */
    public function getWorkers()
    {
        try {
            $workers = $this->workerRepository->findAll();
            return new JsonResponse([
                "workers" => $this->serializer->serialize($workers, 'json'),
                "message" => "Poprawnie pobrano liste pracowników"
            ]);
        } catch (\Exception $exception) {
            return new JsonResponse([
                "message" => "Błąd podczas pobierania listy pracowników",
                "error" => "Błąd podczas pobierania listy pracowników"
            ],400);
        }
    }

    /**
     * @Route("/user/noworker", name="user_noworker", methods={"GET"})
     */
    public function getUserNoWorker()
    {
        try {
            $users = $this->userRepository->findNoWorker();

            return new JsonResponse([
                "users" => $this->serializer->serialize($users, 'json'),
                "message" => "Poprawnie pobrano liste użytkowników"
            ]);
        } catch (\Exception $exception) {
            return new JsonResponse([
                "message" => "Błąd podczas pobierania listy użytkowników",
                "error" => $exception->getMessage()
            ],400);
        }
    }

    /**
     * @Route("/worker/user", name="add_user_to_worker", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function addWorkerToUser(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);
            if (
                array_key_exists("salary", $data) &&
                array_key_exists("bonus", $data) &&
                array_key_exists("departmentId", $data) &&
                array_key_exists("userId", $data) &&
                array_key_exists("roles", $data)
            ) {
                $user = $this->userRepository->find($data["userId"]);
                if(!$user){
                    return new JsonResponse([
                        "message" => "Brak użytkownika nr {$data['userId']}",
                        "error" => "Brak użytkownika nr {$data['userId']}"
                    ],400);
                }
                if($user->getWorker()){
                    return new JsonResponse([
                        "message" => "Użytkownik o nr {$data['userId']} ma już przypisanego pracownika",
                        "error" => "Użytkownik o nr {$data['userId']} ma już przypisanego pracownika"
                    ],400);
                }
                $department = $this->departmentRepository->find($data["departmentId"]);
                if(!$department){
                    return new JsonResponse([
                        "message" => "Brak departamentu nr {$data['departmentId']}",
                        "error" => "Brak departamentu nr {$data['departmentId']}"
                    ],400);
                }
                $worker = new Worker($data['salary'], $data['bonus'], $user, $department);
                $user->setRoles($data['roles']);
                $this->entityManager->persist($worker);
                $this->entityManager->flush();
                return new JsonResponse([
                    "message" => "Poprawnie pobrano dodano pracownika"
                ]);
            } else {
                return new JsonResponse([
                    "message" => "Nie wypełniłeś wszystkich pól",
                    "error" => "Sprwadź pola salary, bonus, departmentId, userId"
                ],400);
            }
        } catch (\Exception $exception) {
            return new JsonResponse([
                "message" => "Błąd podczas dodawanie pracownika",
                "error" => $exception->getMessage()
            ],400);
        }
    }

    /**
     * @Route("/user/edit/{id}", name="user_edit", methods={"POST"}, requirements={"id"="\d+"})
     * @param Request $request
     * @param int     $id
     * @return JsonResponse
     */
    public function editUser(Request $request, int $id)
    {
        try {
            $data = json_decode($request->getContent(), true);
            $user = $this->userRepository->find($id);
            if (!$user) {
                return new JsonResponse([
                    'message' => "Brak użytkownika o nr {$id}"
                ], 400);
            } else {
                if (array_key_exists("password", $data)) {
                    $user->setPassword($this->encoder->encodePassword($user, $data['password']));
                }
                if(array_key_exists("firstName", $data)){
                    $user->setFirstName($data['firstName']);
                }
                if(array_key_exists("lastName", $data)){
                    $user->setLastName($data['lastName']);
                }
                if(array_key_exists("roles", $data)){
                    $user->setRoles($data['roles']);
                }
                $this->entityManager->flush();

                return new JsonResponse([
                    'message' => "Użytkownik został poprawnie zedytowany"
                ]);
            }
        } catch (\Exception $exception) {
            return new JsonResponse([
                "message" => "Błąd podczas edycji użytkownika",
                "error" => $exception->getMessage()
            ],400);
        }
    }

    /**
     * @Route("/worker/edit/{id}", name="worker_edit", methods={"POST"}, requirements={"id"="\d+"})
     * @param Request $request
     * @param int     $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function workerEdit(Request $request, int $id)
    {
        try {
            $data = json_decode($request->getContent(), true);
            $worker = $this->workerRepository->find($id);
            if (!$worker) {
                return new JsonResponse([
                    'message' => "Brak pracownika o nr {$id}"
                ], 400);
            }
            $user = $worker->getUser();
            if (!$user) {
                return new JsonResponse([
                    'message' => "Brak użytkownika o nr {$id}"
                ], 400);
            } else {
                if (array_key_exists("password", $data)) {
                    $user->setPassword($this->encoder->encodePassword($user, $data['password']));
                }
                if(array_key_exists("firstName", $data)){
                    $user->setFirstName($data['firstName']);
                }
                if(array_key_exists("lastName", $data)){
                    $user->setLastName($data['lastName']);
                }
                if(array_key_exists("roles", $data)){
                    $user->setRoles($data['roles']);
                }
                if(array_key_exists("salary", $data)){
                    $worker->setSalary($data['salary']);
                }
                if(array_key_exists("bonus", $data)){
                    $worker->setBonus($data['bonus']);
                }
                if(array_key_exists("finishedWork", $data) &&  !$worker->getDateTo()){
                    $worker->setDateTo(new \DateTime('now'));
                    $user->setRoles(["ROLE_USER"]);
                }
                if(array_key_exists("department", $data)){
                    $department = $this->departmentRepository->find($data["departmentId"]);
                    if(!$department){
                        return new JsonResponse([
                            "message" => "Brak departamentu nr {$data['departmentId']}",
                            "error" => "Brak departamentu nr {$data['departmentId']}"
                        ],400);
                    }
                    $worker->setDepartment($department);
                }
                $this->entityManager->flush();

                return new JsonResponse([
                    'message' => "Pracownik został poprawnie zedytowany"
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                "message" => "Błąd podczas edycji pracownika",
                "error" => $e->getMessage()
            ],400);
        }
    }


    /**
     * @Route("/login", name="api_user_logIn")
     * @param Request $request
     * @return JsonResponse
     */
    public function logIn(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
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
            if (
                array_key_exists("username", $data) &&
                array_key_exists("password", $data) &&
                array_key_exists("firstName", $data) &&
                array_key_exists("lastName", $data)
            ) {
            $user = new User();
            $user->setUsername($data['username']);
            $user->setFirstName($data['firstName']);
            $user->setLastName($data['lastName']);
            $user->setPassword($this->encoder->encodePassword($user, $data['password']));
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            } else {
                return new JsonResponse([
                    'message' => "Użytkownik nie został zarejestrowany, wypełnij brakujące pola",
                    'error' => "Sprawdź pola username, firstName, lastName, password"
                ],400);
            }

            return JsonResponse::create([
                'message' => "dodano"
            ]);
        }
    }

    /**
     * @Route("/user/{id}", name="user_getById", methods={"GET"})
     * @param int $id
     * @return JsonResponse
     */
    public function getUserById(int $id)
    {
        try {
            $user = $this->userRepository->findOneBy(["id" => $id]);
            if($user) {
                return JsonResponse::create([
                    "user" => $this->serializer->serialize($user, 'json')
                ]);
            }
            return JsonResponse::create(["message" => "Brak użytkownika o numerze: {$id}"], 400);
        } catch (\Exception $e) {
            return JsonResponse::create([
                "message" => "Brak użytkownika o numerze: {$id}",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @Route("/worker/{id}", name="worker_getById", methods={"GET"})
     * @param int $id
     * @return JsonResponse
     */
    public function getWorkerById(int $id)
    {
        try {
            $worker = $this->workerRepository->findOneBy(["id" => $id]);
            if($worker) {
                return JsonResponse::create([
                    "worker" => $this->serializer->serialize($worker, 'json')
                ]);
            }
            return JsonResponse::create(["message" => "Brak pracownika o numerze: {$id}"], 400);
        } catch (\Exception $e) {
            return JsonResponse::create([
                "message" => "Brak pracownika o numerze: {$id}",
                "error" => $e->getMessage()
            ], 400);
        }
    }
}
