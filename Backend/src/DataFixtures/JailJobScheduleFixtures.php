<?php

namespace App\DataFixtures;

use App\Entity\JailJob;
use App\Entity\JailJobSchedule;
use App\Entity\Prisoner;
use App\Entity\Worker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class JailJobScheduleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $startStart = strtotime("1 January 2018");
        $endStart = strtotime("1 January 2019");
        $startEnd = strtotime("1 January 2019");
        $endEnd = strtotime("1 July 2019");

        $data = [
            [date("d-m-Y", mt_rand($startStart, $startEnd)),  date("d-m-Y", mt_rand($endStart, $endEnd))],
            [date("d-m-Y", mt_rand($startStart, $startEnd)),  date("d-m-Y", mt_rand($endStart, $endEnd))],
            [date("d-m-Y", mt_rand($startStart, $startEnd)),  date("d-m-Y", mt_rand($endStart, $endEnd))],
            [date("d-m-Y", mt_rand($startStart, $startEnd)),  date("d-m-Y", mt_rand($endStart, $endEnd))],
            [date("d-m-Y", mt_rand($startStart, $startEnd)),  date("d-m-Y", mt_rand($endStart, $endEnd))],
            [date("d-m-Y", mt_rand($startStart, $startEnd)),  date("d-m-Y", mt_rand($endStart, $endEnd))],
            [date("d-m-Y", mt_rand($startStart, $startEnd)),  date("d-m-Y", mt_rand($endStart, $endEnd))],
            [date("d-m-Y", mt_rand($startStart, $startEnd)),  date("d-m-Y", mt_rand($endStart, $endEnd))],
            [date("d-m-Y", mt_rand($startStart, $startEnd)),  date("d-m-Y", mt_rand($endStart, $endEnd))],
        ];
        /** @var JailJob[] $jailJobs */
        $jailJobs = [
            $this->getReference('jailJob0'),
            $this->getReference('jailJob1'),
            $this->getReference('jailJob2'),
            $this->getReference('jailJob3'),
            $this->getReference('jailJob4'),
        ];
        foreach ($data as $key => $p) {
            /** @var Prisoner $prisoner */
            $prisoner = $this->getReference('prisoner'.mt_rand(0,20));
            /** @var Worker $worker */
            $worker = $this->getReference('worker1');
            $jailJobSchedule = new JailJobSchedule(
                $prisoner,
                new \DateTime($p[0]),
                new \DateTime($p[1]),
                $worker,
                $jailJobs[mt_rand(0,4)]
            );
            $manager->persist($jailJobSchedule);
            $this->addReference('jailJobSchedule'.$key, $jailJobSchedule);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return array(
            PrisonerFixtures::class,
            WorkerFixtures::class,
            JailJobFixtures::class,
        );
    }
}
