<?php
/**
 * Created by PhpStorm.
 * User: Paweł
 * Date: 09.04.2019
 * Time: 09:09
 */

namespace App\Tests\Repository;


use App\Entity\MedicalOrder;
use Monolog\TestCase;

class MedicalOrderTest extends TestCase
{
    public function getIdTest() {
        $MedicalOrder = new MedicalOrder();
        $result = $MedicalOrder->getId();

        $this->assertNotNull($result);
    }

    public function setAndGetMedicalProductIdTest() {
        $MedicalOrder = new MedicalOrder();
        $MedicalOrder->setMedicalProductId(112233);
        $result = $MedicalOrder->getMedicalProductId();

        $this->assertNotNull($result);
        $this->assertEquals(112233, $result);
    }
}