<?php
/**
 * Created by PhpStorm.
 * User: Paweł
 * Date: 09.04.2019
 * Time: 09:08
 */

namespace App\Tests\Repository;


use PHPUnit\Framework\TestCase;

class LastWishStaffTest extends TestCase
{
    public function getIdTest() {
        $LastWishStaff = new \App\Entity\LastWishStaff();
        $result = $LastWishStaff->getId();

        $this->assertNotNull($result);
    }

    public function setAndGetLastWishStaffNameTest() {
        $LastWishStaff = new \App\Entity\LastWishStaff();
        $LastWishStaff->setLastWishStaffName("testValue");
        $result = $LastWishStaff->getLastWishStaffName();

        $this->assertNotNull($result);
        $this->assertEquals("testValue", $result);
    }
}