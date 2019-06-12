<?php

namespace App\Controller\Api;

use App\Entity\Department;
use App\Entity\User;
use App\Repository\DepartmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DepartmentController
 * @IsGranted(User::GUARD)
 * @Route("/api/department")
 * @package App\Controller\Api
 */
class DepartmentController extends AbstractController
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
     * @DepartmentRepository $departmentRepository
     */
    private $departmentRepository;


    /**
     * BlockController constructor.
     * @param EntityManagerInterface $entityManager
     * @param SerializerInterface $serializer
     * @param DepartmentRepository $departmentRepository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        DepartmentRepository $departmentRepository
    ){
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
        $this->departmentRepository = $departmentRepository;
    }


    /**
     * @Route(name="department_list", methods={"GET"})
     * @return JsonResponse
     */
    public function list()
    {
        try {
            return new JsonResponse([
                "message" => "Lista została poprawnie pobrana",
                "departments" => $this->serializer->serialize($this->departmentRepository->findAll(), 'json', SerializationContext::create()->enableMaxDepthChecks())
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                "message" => "Lista departamentów nie została poprawnie pobrana",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @Route(name="department_add", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function addDepartment(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);

            if(array_key_exists("departmentName", $data)
            ){
                $department = new Department();
                $department->setDepartmentName($data['departmentName']);
                $this->entityManager->persist($department);
                $this->entityManager->flush();
                return new JsonResponse([
                    "message" => "Departament został poprawnie dodany."
                ]);
            }
            return new JsonResponse([
                "message" => "Departament nie został dodany, brak nazwy",
                "error" => "Sprawdź pole name"
            ], 400);
        } catch (Exception $e) {
            return new JsonResponse([
                "message" => "Departament nie został dodany.",
                "error" => $e->getMessage()
            ], 400);
        }
    }
}
