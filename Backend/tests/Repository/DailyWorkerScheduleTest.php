<?php
/**
 * Created by PhpStorm.
 * User: Paweł
 * Date: 08.04.2019
 * Time: 17:09
 */

namespace App\Tests\Repository;


use PHPUnit\Framework\TestCase;

class DailyWorkerScheduleTest extends TestCase
{
    public function getIdTest() {
        $DailyWorkerSchedule = new \App\Entity\DailyWorkerSchedule();
        $result = $DailyWorkerSchedule->getId();

        $this->assertNotNull($result);
    }

    public function setAndGetFirstNameTest() {
        $DailyWorkerSchedule = new \App\Entity\DailyWorkerSchedule();
        $DailyWorkerSchedule->setWorkerId(15);
        $result = $DailyWorkerSchedule->getWorkerId();

        $this->assertNotNull($result);
        $this->assertEquals(15, $result);
    }

    public function setAndGetDateFromTest() {
        $DailyWorkerSchedule = new \App\Entity\DailyWorkerSchedule();
        $DailyWorkerSchedule->setDateFrom("18-02-2019");
        $result = $DailyWorkerSchedule->getDateFrom();

        $this->assertNotNull($result);
        $this->assertEquals("18-02-2019", $result);
    }

    public function setAndGetDateToTest() {
        $DailyWorkerSchedule = new \App\Entity\DailyWorkerSchedule();
        $DailyWorkerSchedule->setDateTo("10-06-2019");
        $result = $DailyWorkerSchedule->getDateTo();

        $this->assertNotNull($result);
        $this->assertEquals("10-06-2019", $result);
    }
}