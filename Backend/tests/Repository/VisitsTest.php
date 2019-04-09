<?php
/**
 * Created by PhpStorm.
 * User: Paweł
 * Date: 08.04.2019
 * Time: 16:30
 */

namespace App\Tests\Repository;


use App\Entity\Visits;
use Monolog\TestCase;

class VisitsTest extends TestCase
{
    public function getIdTest() {
        $Visits = new Visits();
        $result = $Visits->getId();

        $this->assertNotNull($result);
    }

    public function setAndGetPrisonerIdTest() {
        $Visits = new Visits();
        $Visits->setPrisonerId(17);
        $result = $Visits->getPrisonerId();

        $this->assertNotNull($result);
        $this->assertEquals(17, $result);
    }

    public function setAndGetVisitDateTest() {
        $Visits = new Visits();
        $Visits->setVisitDate("07-04-2019");
        $result = $Visits->getVisitDate();

        $this->assertNotNull($result);
        $this->assertEquals("07-04-2019", $result);
    }
}