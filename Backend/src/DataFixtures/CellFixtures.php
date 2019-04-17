<?php

namespace App\DataFixtures;

use App\Entity\Block;
use App\Entity\Cell;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CellFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /** @var Block $blockA */
        $blockA = $this->getReference('blockA');
        /** @var Block $blockB */
        $blockB = $this->getReference('blockB');

        for($i = 1; $i<27; $i++){
            $cell = new Cell();
            $this->addReference("cell{$i}", $cell);
            $blockA->addCell($cell);
            $manager->persist($cell);
        }

        for($i = 27; $i<53; $i++){
            $cell = new Cell();
            $this->addReference("cell{$i}", $cell);
            $blockB->addCell($cell);
            $manager->persist($cell);
        }

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
            BlockFixtures::class,
        );
    }
}