<?php

namespace App\DataFixtures;

use App\Entity\Department;
use App\Entity\User;
use App\Entity\Worker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class WorkerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $data = [
            [rand(1000,10000), rand(100,700), "department1"],
            [rand(1000,10000), rand(100,700), "department1"],
            [rand(1000,10000), rand(100,700), "department1"],
            [rand(1000,10000), rand(100,700), "department1"],
            [rand(1000,10000), rand(100,700), "department2"],
            [rand(1000,10000), rand(100,700), "department2"],
            [rand(1000,10000), rand(100,700), "department2"],
            [rand(1000,10000), rand(100,700), "department2"],
            [rand(1000,10000), rand(100,700), "department3"],
            [rand(1000,10000), rand(100,700), "department3"],
            [rand(1000,10000), rand(100,700), "department3"],
            [rand(1000,10000), rand(100,700), "department3"],
            [rand(1000,10000), rand(100,700), "department4"],
            [rand(1000,10000), rand(100,700), "department4"],
            [rand(1000,10000), rand(100,700), "department4"],
            [rand(1000,10000), rand(100,700), "department4"],
            [rand(1000,10000), rand(100,700), "department5"],
            [rand(1000,10000), rand(100,700), "department5"],
            [rand(1000,10000), rand(100,700), "department5"],
            [rand(1000,10000), rand(100,700), "department5"],
            [rand(1000,10000), rand(100,700), "department6"],
            [rand(1000,10000), rand(100,700), "department6"],
            [rand(1000,10000), rand(100,700), "department6"],
            [rand(1000,10000), rand(100,700), "department6"],
            [rand(1000,10000), rand(100,700), "department7"],
            [rand(1000,10000), rand(100,700), "department7"],
        ];

        foreach ($data as $key => $w) {
            /** @var Department $department */
            $department = $this->getReference($w[2]);
            /** @var User $user */
            $user = $this->getReference("user".$key);
            $worker = new Worker($w[0], $w[1], $user, $department);
            $this->addReference("worker".$key,$worker);
            $manager->persist($worker);
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
            DepartmentFixtures::class,
            UserFixtures::class
        );
    }
}
