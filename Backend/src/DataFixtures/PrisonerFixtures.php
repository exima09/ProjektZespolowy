<?php

namespace App\DataFixtures;

use App\Entity\Cell;
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
        /** @var Cell $cell1 */
        $cell1 = $this->getReference('cell6');
        /** @var Cell $cell2 */
        $cell2 = $this->getReference('cell2');

        $prisoner = new Prisoner(
            "Jan",
            "Piotrowski",
            new \DateTime("01-01-2019"),
            new \DateTime("01-01-2001")
        );
        $cell1->setPrisoner($prisoner);
        $manager->persist($prisoner);
        $this->addReference('prisoner1', $prisoner);

        $prisoner2 = new Prisoner(
            "Tester",
            "Testowy",
            new \DateTime('now'),
            new \DateTime("02-01-1990")
        );
        $cell2->setPrisoner($prisoner2);
        $manager->persist($prisoner2);
        $this->addReference('prisoner2', $prisoner2);

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
