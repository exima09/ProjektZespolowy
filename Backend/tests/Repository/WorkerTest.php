<?php
/**
 * Created by PhpStorm.
 * User: Paweł
 * Date: 08.04.2019
 * Time: 16:21
 */

namespace App\Tests\Repository;


use App\Entity\Worker;
use PHPUnit\Framework\TestCase;

class WorkerTest extends TestCase
{
    public function getIdTest() {
        $Worker = new Worker();
        $result = $Worker->getId();

        $this->assertNotNull($result);
    }

    public function setAndGetFirstNameTest() {
        $Worker = new Worker();
        $Worker->setFirstName("testName");
        $result = $Worker->getFirstName();

        $this->assertNotNull($result);
        $this->assertEquals("testName", $result);
    }

    public function setAndGetLastNameTest() {
        $Worker = new Worker();
        $Worker->setLastName("testLastName");
        $result = $Worker->getLastName();

        $this->assertNotNull($result);
        $this->assertEquals("testLastName", $result);
    }

    public function setAndGetDepartamentIdTest() {
        $Worker = new Worker();
        $Worker->setDepartamentId(2);
        $result = $Worker->getDepartamentId();

        $this->assertNotNull($result);
        $this->assertEquals(2, $result);
    }

    public function setAndGetSalaryTest() {
        $Worker = new Worker();
        $Worker->setSalary(1234);
        $result = $Worker->getSalary();

        $this->assertNotNull($result);
        $this->assertEquals(1234, $result);
    }

    public function setAndGetBonusTest() {
        $Worker = new Worker();
        $Worker->setBonus(555);
        $result = $Worker->getBonus();

        $this->assertNotNull($result);
        $this->assertEquals(555, $result);
    }

    public function setAndGetDateFromTest() {
        $Worker = new Worker();
        $Worker->setDateFrom("01-02-2019");
        $result = $Worker->getDateFrom();

        $this->assertNotNull($result);
        $this->assertEquals("01-02-2019", $result);
    }

    public function setAndGetDateToTest() {
        $Worker = new Worker();
        $Worker->setDateTo("21-05-2019");
        $result = $Worker->getDateTo();

        $this->assertNotNull($result);
        $this->assertEquals("21-05-2019", $result);
    }
}