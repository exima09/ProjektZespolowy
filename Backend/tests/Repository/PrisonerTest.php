<?php

namespace App\Tests\Repository;

use App\Entity\Prisoner;
use Monolog\TestCase;

class PrisonerTest extends TestCase
{
    public function getIdTest() {
        $Prisoner = new Prisoner();
        $result = $Prisoner->getId();

        $this->assertNotNull($result);
    }

    public function setAndGetFirstNameTest() {
        $Prisoner = new Prisoner();
        $Prisoner->setFirstName("testName");
        $result = $Prisoner->getFirstName();

        $this->assertNotNull($result);
        $this->assertEquals("testName", $result);
    }

    public function setAndGetLastNameTest() {
        $Prisoner = new Prisoner();
        $Prisoner->setLastName("testLastName");
        $result = $Prisoner->getLastName();

        $this->assertNotNull($result);
        $this->assertEquals("testLastName", $result);
    }

    public function setAndGetJoinDateTest() {
        $Prisoner = new Prisoner();
        $Prisoner->setJoinDate("01-02-2019");
        $result = $Prisoner->getJoinDate();

        $this->assertNotNull($result);
        $this->assertEquals("01-02-2019", $result);
    }

    public function setAndGetDateOfBirthTest() {
        $Prisoner = new Prisoner();
        $Prisoner->setDateOfBirth("14-07-2019");
        $result = $Prisoner->getDateOfBirth();

        $this->assertNotNull($result);
        $this->assertEquals("14-07-2019", $result);
    }

    public function setAndGetCellIdTest() {
        $Prisoner = new Prisoner();
        $Prisoner->setCellId(69);
        $result = $Prisoner->getCellId();

        $this->assertNotNull($result);
        $this->assertEquals(69, $result);
    }
}