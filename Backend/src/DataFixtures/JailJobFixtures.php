<?php

namespace App\DataFixtures;

use App\Entity\JailJob;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class JailJobFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $data = [
            "Sprzątanie wiezienia",
            "Zakład stolarski",
            "Firma budowlana",
            "Firma sprzątająca",
            "Firma gastronomiczna"
        ];
        foreach ($data as $key => $p) {
            $jailJob = new JailJob(
                $p
            );
            $manager->persist($jailJob);
            $this->addReference('jailJob'.$key, $jailJob);
        }

        $manager->flush();
    }
}
