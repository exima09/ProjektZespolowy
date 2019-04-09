<?php
/**
 * Created by PhpStorm.
 * User: Paweł
 * Date: 08.04.2019
 * Time: 16:57
 */

namespace App\Tests\Repository;


use App\Entity\SocialOrder;
use Monolog\TestCase;

class SocialOrderTest extends TestCase
{
    public function getIdTest() {
        $SocialOrder = new SocialOrder();
        $result = $SocialOrder->getId();

        $this->assertNotNull($result);
    }

    public function setAndGetSocialProductTest() {
        $SocialOrder = new SocialOrder();
        $SocialOrder->setSocialProductId(33);
        $result = $SocialOrder->getSocialProductId();

        $this->assertNotNull($result);
        $this->assertEquals(33, $result);
    }
}