<?php

namespace App\DataFixtures;

use App\Entity\ApplicationStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ApplicationStatusFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $status = new ApplicationStatus();
        $status->setName("Nowe");
        $this->addReference('statusNew', $status);
        $manager->persist($status);

        $status1 = new ApplicationStatus();
        $status1->setName("Zaakceptowane");
        $this->addReference('statusAccepted', $status1);
        $manager->persist($status1);

        $status2 = new ApplicationStatus();
        $status2->setName("Odrzucone");
        $this->addReference('statusAbort', $status2);
        $manager->persist($status2);

        $manager->flush();
    }
}
