<?php

namespace App\DataFixtures;

use App\Entity\Alarm;
use App\Entity\Worker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AlarmFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /** @var Worker $worker */
        $worker = $this->getReference('worker1');

        /** @var Worker $worker1 */
        $worker1 = $this->getReference('worker15');
        $alarm = new Alarm();
        $alarm->setDateStart(new \DateTime('now'));
        $alarm->setDateStop(new \DateTime('now'));
        $alarm->setWorkerStart($worker);
        $alarm->setWorkerStop($worker1);

        $manager->persist($alarm);
        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            WorkerFixtures::class
        ];
    }
}
