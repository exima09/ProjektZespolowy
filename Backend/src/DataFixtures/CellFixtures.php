<?php

namespace App\DataFixtures;

use App\Entity\Cell;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CellFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $cell1 = new Cell();
        $this->addReference('cell1', $cell1);
        $manager->persist($cell1);

        $cell2 = new Cell();
        $this->addReference('cell2', $cell2);
        $manager->persist($cell2);

        $cell3 = new Cell();
        $this->addReference('cell3', $cell3);
        $manager->persist($cell3);

        $manager->flush();
    }
}