<?php

namespace App\DataFixtures;

use App\Entity\Prisoner;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PrisonerFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $prisoner = new Prisoner();
        $prisoner->setFirstName("Jan");
        $prisoner->setLastName("Piotrowski");
        $prisoner->setJoinDate(new \DateTime("01-01-2019"));
        $prisoner->setDateOfBirdth(new \DateTime("01-01-2001"));
        $prisoner->setCellId(1);
        $manager->persist($prisoner);

        $prisoner2 = new Prisoner();
        $prisoner2->setFirstName("Tester");
        $prisoner2->setLastName("Testowy");
        $prisoner2->setJoinDate(new \DateTime('now'));
        $prisoner2->setDateOfBirdth(new \DateTime("01-01-1990"));
        $prisoner2->setCellId(2);
        $manager->persist($prisoner2);

        $manager->flush();
    }
}
