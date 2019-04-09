<?php
/**
 * Created by PhpStorm.
 * User: Paweł
 * Date: 08.04.2019
 * Time: 17:15
 */

namespace App\Tests\Repository;


use App\Entity\Execution;
use Monolog\TestCase;

class ExecutionTest extends TestCase
{
    public function getIdTest() {
        $Execution = new Execution();
        $result = $Execution->getId();

        $this->assertNotNull($result);
    }

    public function setAndGetExecutionTest() {
        $Execution = new Execution();
        $Execution->setExecutionDate("24-12-2019");
        $result = $Execution->getExecutionDate();

        $this->assertNotNull($result);
        $this->assertEquals("24-12-2019", $result);
    }

    public function setAndGetPrisonerIdTest() {
        $Execution = new Execution();
        $Execution->setPrisonerId(1);
        $result = $Execution->getPrisonerId();

        $this->assertNotNull($result);
        $this->assertEquals(1, $result);
    }

    public function setAndGetWorkerIdTest() {
        $Execution = new Execution();
        $Execution->setWorkerId(5);
        $result = $Execution->getWorkerId();

        $this->assertNotNull($result);
        $this->assertEquals(5, $result);
    }

    public function setAndGetHasDoneTest() {
        $Execution = new Execution();
        $Execution->setHasDone(true);
        $result = $Execution->getHasDone();

        $this->assertNotNull($result);
        $this->assertTrue(true, $result);
    }

    public function setAndGetLastWishOrderIdTest() {
        $Execution = new Execution();
        $Execution->setLastWishOrderId(7);
        $result = $Execution->getLastWishOrderId();

        $this->assertNotNull($result);
        $this->assertEquals(7, $result);
    }
}