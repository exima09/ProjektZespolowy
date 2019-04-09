<?php
/**
 * Created by PhpStorm.
 * User: Paweł
 * Date: 09.04.2019
 * Time: 09:12
 */

namespace App\Tests\Repository;


use App\Entity\MedicalProducts;
use Monolog\TestCase;

class MedicalProductTest extends TestCase
{
    public function getIdTest() {
        $MedicalProduct = new MedicalProducts();
        $result = $MedicalProduct->getId();

        $this->assertNotNull($result);
    }

    public function setAndGetMedicalProductNameTest() {
        $MedicalProduct = new MedicalProducts();
        $MedicalProduct->setMedicalProductName("testName");
        $result = $MedicalProduct->getMedicalProductName();

        $this->assertNotNull($result);
        $this->assertEquals("testName", $result);
    }
}