<?php
/**
 * Created by PhpStorm.
 * User: Paweł
 * Date: 09.04.2019
 * Time: 09:19
 */

namespace App\Tests\Repository;


use App\Entity\Supplies;
use PHPUnit\Framework\TestCase;

class SuppliesTest extends TestCase
{
    public function getIdTest() {
        $Supplies = new Supplies();
        $result = $Supplies->getId();

        $this->assertNotNull($result);
    }

    public function setAndGetFirstNameTest() {
        $Supplies = new Supplies();
        $Supplies->setSupplyName("testName");
        $result = $Supplies->getSupplyName();

        $this->assertNotNull($result);
        $this->assertEquals("testName", $result);
    }
}