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
        /** @var Department $department */
        $department = $this->getReference("department1");

        /** @var User $user1 */
        $user1 = $this->getReference("user1");
        $worker = new Worker();
        $worker->setBonus(1000);
        try {
            $worker->setDateFrom(new \DateTime("now"));
        } catch (\Exception $e) {
        }
        $worker->setDepartment($department);
        $worker->setSalary(10000);
        $worker->setUser($user1);
        $this->addReference("worker1",$worker);
        $manager->persist($worker);

        /** @var User $user3 */
        $user3 = $this->getReference("user3");
        $worker = new Worker();
        $worker->setBonus(300);
        try {
            $worker->setDateFrom(new \DateTime("now"));
        } catch (\Exception $e) {
        }
        $worker->setDepartment($department);
        $worker->setSalary(5000);
        $worker->setUser($user3);
        $manager->persist($worker);


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
