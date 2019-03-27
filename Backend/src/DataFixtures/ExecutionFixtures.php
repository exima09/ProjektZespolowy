<?php

namespace App\DataFixtures;

use App\Entity\Execution;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ExecutionFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $prisoner1 = $this->getReference('prisoner1');
        $prisoner2 = $this->getReference('prisoner2');

        $date = strtotime('+7 day', strtotime('now'));
        $execution1 = new Execution((new \DateTime())->setTimestamp($date)->setTime(10, 0,0), 1, 0, 1, $prisoner1);
        $execution2 = new Execution((new \DateTime())->setTimestamp($date)->setTime(14, 0,0), 1, 0, 1, $prisoner2);

        $manager->persist($execution1);
        $manager->persist($execution2);
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
        return array(
            PrisonerFixtures::class,
        );
    }
}