<?php
/**
 * Created by PhpStorm.
 * User: Paweł
 * Date: 08.04.2019
 * Time: 16:42
 */

namespace App\Tests\Repository;


use App\Entity\SupplyOrder;
use Monolog\TestCase;

class SupplyOrderTest extends TestCase
{
    public function getIdTest() {
        $SupplyOrder = new SupplyOrder();
        $result = $SupplyOrder->getId();

        $this->assertNotNull($result);
    }

    public function setAndGetSupplyIdTest() {
        $SupplyOrder = new SupplyOrder();
        $SupplyOrder->setFirstName(632);
        $result = $SupplyOrder->getFirstName();

        $this->assertNotNull($result);
        $this->assertEquals(632, $result);
    }
}