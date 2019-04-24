<?php

namespace App\DataFixtures;

use App\Entity\Department;
use App\Entity\Worker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class WorkerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /** @var Department $department */
        $department = $this->getReference("department1");
        $worker = new Worker();
        $worker->setFirstName("David");
        $worker->setLastName("Juszak");
        $worker->setBonus(1000);
        try {
            $worker->setDateFrom(new \DateTime("now"));
        } catch (\Exception $e) {
        }
        $worker->setDepartment($department);
        $worker->setSalary(10000);
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
