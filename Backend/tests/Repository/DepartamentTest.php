<?php
/**
 * Created by PhpStorm.
 * User: Paweł
 * Date: 08.04.2019
 * Time: 17:13
 */

namespace App\Tests\Repository;


use App\Entity\Department;
use PHPUnit\Framework\TestCase;

class DepartmentTest extends TestCase
{
    public function getIdTest() {
        $Department = new Department();
        $result = $Department->getId();

        $this->assertNotNull($result);
    }

    public function setAndGetFirstNameTest() {
        $Department = new Department();
        $Department->setDepartmentName("testName");
        $result = $Department->getDepartmentName();

        $this->assertNotNull($result);
        $this->assertEquals("testName", $result);
    }

}