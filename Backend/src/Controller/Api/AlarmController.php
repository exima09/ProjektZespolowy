<?php

namespace App\Controller\Api;

use App\Entity\Alarm;
use App\Entity\User;
use App\Repository\AlarmRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AlarmController
 * @Route("/api/alarm")
 * @IsGranted(User::USER)
 * @package App\Controller
 */
class AlarmController extends AbstractController
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
     * @AlarmRepository $alarmRepository
     */
    private $alarmRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        AlarmRepository $alarmRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
        $this->alarmRepository = $alarmRepository;
    }

    /**
     * @Route(name="alarm" , methods={"GET"})
     */
    public function currentAlarm()
    {
        try {
            $alarms = $this->alarmRepository->findOneBy(["dateStop" => null]);
            return $this->json([
                'isAlarmActive' => $alarms == null ? false : true,
            ]);
        } catch (\Exception $exception) {
            return $this->json([
                "error" => $exception->getMessage(),
                "message" => "Nie można sprawdzić czy alarm jest włączony"
            ],400);
        }
    }

    /**
     * @Route("/list", name="alarm_list" , methods={"GET"})
     */
    public function list()
    {
        try {
            return $this->json([
                'alarms' => $this->serializer->serialize($this->alarmRepository->findAll(), 'json'),
            ]);
        } catch (\Exception $exception) {
            return $this->json([
                "error" => $exception->getMessage(),
                "message" => "Nie można pobrać listy alarmów"
            ],400);
        }
    }

    /**
     * @Route(name="alarm_add" , methods={"POST"})
     */
    public function add()
    {
        try {
            $alarm = new Alarm();
            $alarm->setDateStart(new \DateTime('now'));
            $worker = $this->getUser()->getWorker();
            if(!$worker){
                return $this->json([
                    "error" => "Brak funkcji pracownika lub brak uprawnień",
                    "message" => "Brak funkcji pracownika lub brak uprawnień"
                ],400);
            }
            $alarm->setWorkerStart($worker);
            $this->entityManager->persist($alarm);
            $this->entityManager->flush();
            return $this->json([
                'message' => "Alarm został dodany",
            ]);
        } catch (\Exception $exception) {
            return $this->json([
                "error" => $exception->getMessage(),
                "message" => "Nie można dodać alarmu"
            ],400);
        }
    }

    /**
     * @Route(name="alarm_finish" , methods={"PATCH"})
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function finishAlarm()
    {
        try {
            $alarm = $this->alarmRepository->findOneBy(["dateStop" => null]);
            if(!$alarm){
                return $this->json([
                    "error" => "Brak aktywnego alarmu",
                    "message" => "Brak aktywnego alarmu"
                ],400);
            }
            $alarm->setDateStop(new \DateTime('now'));
            $worker = $this->getUser()->getWorker();
            if(!$worker){
                return $this->json([
                    "error" => "Brak funkcji pracownika lub brak uprawnień",
                    "message" => "Brak funkcji pracownika lub brak uprawnień"
                ],400);
            }
            $alarm->setWorkerStop($worker);
            $this->entityManager->flush();
            return $this->json([
                'message' => "Alarm został zakończony",
            ]);
        } catch (\Exception $exception) {
            return $this->json([
                "error" => $exception->getMessage(),
                "message" => "Nie można dodać alarmu"
            ],400);
        }
    }
}
