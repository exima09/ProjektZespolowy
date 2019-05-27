<?php

namespace App\DataFixtures;

use App\Entity\Department;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DepartmentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $data = [
            "Oddział administracyjny",
            "Oddział straży więziennej",
            "Oddział socjalny",
            "Oddział medyczny",
            "Oddział egzekucyjny",
            "Oddział kadr",
            "Oddział kierownictwa",
        ];

        foreach ($data as $key => $d) {
            $department = new Department();
            $department->setDepartmentName($d);
            $this->addReference("department".($key+1), $department);
            $manager->persist($department);
        }

        $manager->flush();
    }
}
