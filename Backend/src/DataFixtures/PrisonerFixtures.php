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
        $startBirth = strtotime("1 January 1950");
        $endBirth = strtotime("1 January 2000");
        $startJoin = strtotime("1 January 2000");
        $endJoin = strtotime("1 July 2019");

        $data = [
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
            ["Jan", "Piotrowski", date("d-m-Y", mt_rand($startBirth, $endBirth)),  date("d-m-Y", mt_rand($startJoin, $endJoin))],
        ];

        foreach ($data as $key => $p) {
            /** @var Cell $cell */
            $cell = $this->getReference('cell'.($key+1));
            $prisoner = new Prisoner(
                $p[0].($key+1),
                $p[1].($key+1),
                new \DateTime($p[2]),
                new \DateTime($p[3])
            );
            $prisoner->setCell($cell);
            $manager->persist($prisoner);
            $this->addReference('prisoner'.$key, $prisoner);
        }

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
