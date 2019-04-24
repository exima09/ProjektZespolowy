<?php

namespace App\DataFixtures;

use App\Entity\Block;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BlockFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $blockA = new Block();
        $blockA->setName("A");
        $this->addReference('blockA', $blockA);
        $manager->persist($blockA);

        $blockB = new Block();
        $blockB->setName("B");
        $this->addReference('blockB', $blockB);
        $manager->persist($blockB);

        $manager->flush();
    }
}
