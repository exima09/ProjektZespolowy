<?php

namespace App\Controller\Api;

use App\Entity\JailJob;
use App\Entity\JailJobSchedule;
use App\Entity\Prisoner;
use App\Entity\User;
use App\Entity\Worker;
use App\Repository\JailJobRepository;
use App\Repository\JailJobScheduleRepository;
use App\Repository\PrisonerRepository;
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
 * Class JailJobController
 * @IsGranted(User::GUARD)
 * @Route("/api/jail-job")
 * @package App\Controller\Api
 */
class JailJobController extends AbstractController
{
    /**
     * @var JailJobRepository $jailJobRepository
     */
    private $jailJobRepository;
    /**
     * @var JailJobScheduleRepository $jailJobScheduleRepository
     */
    private $jailJobScheduleRepository;
    /**
     * @var PrisonerRepository $prisonerRepository
     */
    private $prisonerRepository;
    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;
    /**
     * @var SerializerInterface $serializer
     */
    private $serializer;

    /**
     * JailJobController constructor.
     * @param JailJobRepository         $jailJobRepository
     * @param JailJobScheduleRepository $jailJobScheduleRepository
     * @param PrisonerRepository        $prisonerRepository
     * @param EntityManagerInterface    $entityManager
     * @param SerializerInterface       $serializer
     */
    public function __construct(
        JailJobRepository $jailJobRepository,
        JailJobScheduleRepository $jailJobScheduleRepository,
        PrisonerRepository $prisonerRepository,
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer
    )
    {
        $this->jailJobRepository = $jailJobRepository;
        $this->jailJobScheduleRepository = $jailJobScheduleRepository;
        $this->prisonerRepository = $prisonerRepository;
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }


    /**
     * @Route("", name="jail_job_list", methods={"GET"})
     */
    public function list()
    {
        try {
            return $this->json([
                'jobs' => $this->serializer->serialize($this->jailJobRepository->findAll(), 'json', SerializationContext::create()->enableMaxDepthChecks()),
                'message' => "Poprawnie pobrano liste prac"
            ]);
        } catch (\Exception $exception) {
            return $this->json([
                'message' => "Nie udało się pobrać listy prac",
                'error' => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * @Route("/schedule", name="jail_job_schedule_list", methods={"GET"})
     */
    public function schedule_list()
    {
        try {
            return $this->json([
                'jobsSchedule' => $this->serializer->serialize($this->jailJobScheduleRepository->findAll(), 'json', SerializationContext::create()->enableMaxDepthChecks()),
                'message' => "Poprawnie pobrano liste prac"
            ]);
        } catch (\Exception $exception) {
            return $this->json([
                'message' => "Nie udało się pobrać listy prac",
                'error' => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * @Route("", name="jail_job_add", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function add_jail_job(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);
            if (array_key_exists("jobName", $data)) {
                $job = new JailJob($data['jobName']);
                $this->entityManager->persist($job);
                $this->entityManager->flush();
            } else {
                return $this->json([
                    'message' => "Nie wprowadzono nazwy pracy",
                    'error' => "Nie wprowadzono nazwy pracy"
                ],400);
            }
            return $this->json([
                'message' => "Poprawnie dodano prace"
            ]);
        } catch (\Exception $exception) {
            return $this->json([
                'message' => "Nie udało się dodac pracy",
                'error' => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * @Route("/schedule", name="jail_job_schedule_add", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function add_jail_job_schedule(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);
            if (
                array_key_exists("prisoner", $data) &&
                array_key_exists("jailJob", $data) &&
                array_key_exists("dateFrom", $data) &&
                array_key_exists("dateTo", $data)
            ) {
                /** @var Worker $worker */
                $worker = $this->getUser()->getWorker();
                if(!$worker){
                    return $this->json([
                        'message' => "Pracownik nie został odnaleziony",
                        'error' => "Pracownik nie został odnaleziony"
                    ], 400);
                }
                /** @var Prisoner $prisoner */
                $prisoner = $this->prisonerRepository->find($data['prisoner']);
                if(!$prisoner){
                    return $this->json([
                        'message' => "Więzień nr {$data['jailJob']} nie został odnaleziony",
                        'error' => "Więzień nr {$data['jailJob']} nie został odnaleziony"
                    ], 400);
                }
                /** @var JailJob $jailJob */
                $jailJob = $this->jailJobRepository->find($data['jailJob']);
                if(!$jailJob){
                    return $this->json([
                        'message' => "Praca nr {$data['jailJob']} nie została odnaleziona",
                        'error' => "Praca nr {$data['jailJob']} nie została odnaleziona"
                    ], 400);
                }
                $jobSchedule = new JailJobSchedule($prisoner, new \DateTime($data['dateFrom']), new \DateTime($data['dateTo']),$worker, $jailJob);
                $this->entityManager->persist($jobSchedule);
                $this->entityManager->flush();
            } else {
                return $this->json([
                    'message' => "Nie wprowadzono prisoner jailJob dateFrom dateTo",
                    'error' => "Nie wprowadzono prisoner jailJob dateFrom dateTo"
                ],400);
            }
            return $this->json([
                'message' => "Poprawnie przydzielono prace"
            ]);
        } catch (\Exception $exception) {
            return $this->json([
                'message' => "Nie udało się przydzielić pracy",
                'error' => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * @Route("/{id}", name="jail_job_delete", methods={"DELETE"}, requirements={"id"="\d+"})
     * @param int $id
     * @return JsonResponse
     */
    public function delete_job(int $id)
    {
        try {
            $job = $this->jailJobRepository->find($id);
            if(!$job){
                return $this->json([
                    'message' => "Nie udało się usunąć pracy, brak numeru {$id}",
                    'error' => "Nie udało się usunąć pracy, brak numeru {$id}"
                ], 400);
            }
            $this->entityManager->remove($job);
            $this->entityManager->flush();
            return $this->json([
                'message' => "Poprawnie usunięto prace"
            ]);
        } catch (\Exception $exception) {
            return $this->json([
                'message' => "Nie udało się usunąć pracy",
                'error' => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * @Route("/schedule/{id}", name="jail_job_schedule_delete", methods={"DELETE"}, requirements={"id"="\d+"})
     * @param int $id
     * @return JsonResponse
     */
    public function delete_job_schedule(int $id)
    {
        try {
            $job = $this->jailJobScheduleRepository->find($id);
            if(!$job){
                return $this->json([
                    'message' => "Nie udało się usunąć pracy, brak numeru {$id}",
                    'error' => "Nie udało się usunąć pracy, brak numeru {$id}"
                ], 400);
            }
            $this->entityManager->remove($job);
            $this->entityManager->flush();
            return $this->json([
                'message' => "Poprawnie usunięto prace"
            ]);
        } catch (\Exception $exception) {
            return $this->json([
                'message' => "Nie udało się usunąć pracy",
                'error' => $exception->getMessage()
            ], 400);
        }
    }
}
