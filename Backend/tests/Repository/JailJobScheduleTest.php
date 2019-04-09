<?php
/**
 * Created by PhpStorm.
 * User: Paweł
 * Date: 08.04.2019
 * Time: 17:22
 */

namespace App\Tests\Repository;


use Monolog\TestCase;

class JailJobScheduleTest extends TestCase
{
    public function getIdTest() {
        $JailJobSchedule = new \App\Entity\JailJobSchedule();
        $result = $JailJobSchedule->getId();

        $this->assertNotNull($result);
    }

    public function setAndGetPrisonerIdTest() {
        $JailJobSchedule = new \App\Entity\JailJobSchedule();
        $JailJobSchedule->setPrisonerId(77);
        $result = $JailJobSchedule->getPrisonerId();

        $this->assertNotNull($result);
        $this->assertEquals(77, $result);
    }

    public function setAndGetJobIdTest() {
        $JailJobSchedule = new \App\Entity\JailJobSchedule();
        $JailJobSchedule->setJobId(3);
        $result = $JailJobSchedule->getJobId();

        $this->assertNotNull($result);
        $this->assertEquals(3, $result);
    }

    public function setAndGetRateTest() {
        $JailJobSchedule = new \App\Entity\JailJobSchedule();
        $JailJobSchedule->setRate(3.7);
        $result = $JailJobSchedule->getRate();

        $this->assertNotNull($result);
        $this->assertEquals(3.7, $result);
    }

    public function setAndGetDateFromTest() {
        $JailJobSchedule = new \App\Entity\JailJobSchedule();
        $JailJobSchedule->setDateFrom("06-10-2019");
        $result = $JailJobSchedule->getDateFrom();

        $this->assertNotNull($result);
        $this->assertEquals("06-10-2019", $result);
    }

    public function setAndGetDateToTest() {
        $JailJobSchedule = new \App\Entity\JailJobSchedule();
        $JailJobSchedule->setDateTo("26-08-2019");
        $result = $JailJobSchedule->getDateTo();

        $this->assertNotNull($result);
        $this->assertEquals("26-08-2019", $result);
    }
}