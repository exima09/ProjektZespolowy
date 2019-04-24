<?php

namespace App\DataFixtures;

use App\Entity\Department;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DepartmentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /** @var Department $department */
        $department = new Department();
        $department->setDepartmentName("Departament 1");
        $this->addReference("department1", $department);
        $manager->persist($department);

        $manager->flush();
    }
}
