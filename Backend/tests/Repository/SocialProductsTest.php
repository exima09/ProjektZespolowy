<?php
/**
 * Created by PhpStorm.
 * User: Paweł
 * Date: 09.04.2019
 * Time: 09:17
 */

namespace App\Tests\Repository;


use App\Entity\SocialProducts;
use PHPUnit\Framework\TestCase;

class SocialProductsTest extends TestCase
{
    public function getIdTest() {
        $SocialProducts = new SocialProducts();
        $result = $SocialProducts->getId();

        $this->assertNotNull($result);
    }

    public function setAndGetFirstNameTest() {
        $SocialProducts = new SocialProducts();
        $SocialProducts->setSocialProductName("testName");
        $result = $SocialProducts->getSocialProductName();

        $this->assertNotNull($result);
        $this->assertEquals("testName", $result);
    }
}