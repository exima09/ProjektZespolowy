<?php

namespace App\DataFixtures;

use App\Entity\Application;
use App\Entity\ApplicationStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ApplicationFixtures extends Fixture  implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /** @var ApplicationStatus $status */
        $status = $this->getReference('statusNew');
        $application = new Application();
        $application->setFirstName("Jan");
        $application->setLastName("Kowalski");
        $application->setEmail("aaa@bbb.pl");
        $application->setPhoneNumber("123321123");
        $application->setStatus($status);
        $application->setFileUrl("../1.pdf");
        $manager->persist($application);
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
            ApplicationStatusFixtures::class,
        );
    }
}
