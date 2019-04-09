<?php
/**
 * Created by PhpStorm.
 * User: Paweł
 * Date: 09.04.2019
 * Time: 09:06
 */

namespace App\Tests\Repository;


use App\Entity\LastWishOrder;
use Monolog\TestCase;

class LastWishOrderTest extends TestCase
{
    public function getIdTest() {
        $LastWishOrder = new LastWishOrder();
        $result = $LastWishOrder->getId();

        $this->assertNotNull($result);
    }

    public function setAndGetLastWishStaffIdTest() {
        $LastWishOrder = new LastWishOrder();
        $LastWishOrder->setLastWishStaffId(68);
        $result = $LastWishOrder->getLastWishStaffId();

        $this->assertNotNull($result);
        $this->assertEquals(68, $result);
    }
}