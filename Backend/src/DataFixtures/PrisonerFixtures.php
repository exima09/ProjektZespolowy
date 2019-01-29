<?php

namespace App\DataFixtures;

use App\Entity\Prisoner;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PrisonerFixtures extends Fixture implements DependentFixtureInterface
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $cell1 = $this->getReference('cell1');
        $cell2 = $this->getReference('cell2');

        $prisoner = new Prisoner(
            "Jan",
            "Piotrowski",
            new \DateTime("01-01-2019"),
            new \DateTime("01-01-2001"),
            1
        );
        $manager->persist($prisoner);

        $prisoner2 = new Prisoner(
            "Tester",
            "Testowy",
            new \DateTime('now'),
            new \DateTime("01-01-1990"),
            2
        );
        $manager->persist($prisoner2);

        $manager->flush();
    }
    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return array(
            CellFixtures::class,
        );
    }

}
