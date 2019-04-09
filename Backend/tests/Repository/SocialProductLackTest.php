<?php
/**
 * Created by PhpStorm.
 * User: Paweł
 * Date: 08.04.2019
 * Time: 17:03
 */

namespace App\Tests\Repository;


use App\Entity\SocialProductLack;
use Monolog\TestCase;

class SocialProductLackTest extends TestCase
{
    public function getIdTest() {
        $SocialProductLack = new SocialProductLack();
        $result = $SocialProductLack->getId();

        $this->assertNotNull($result);
    }

    public function setAndGetSocialProductTest() {
        $SocialProductLack = new SocialProductLack();
        $SocialProductLack->setSocialProductId(21);
        $result = $SocialProductLack->getSocialProductId();

        $this->assertNotNull($result);
        $this->assertEquals(21, $result);
    }

    public function setAndGetNumberOfLackTest() {
        $SocialProductLack = new SocialProductLack();
        $SocialProductLack->setNumberOfLack(1000);
        $result = $SocialProductLack->getNumberOfLack();

        $this->assertNotNull($result);
        $this->assertEquals(1000, $result);
    }
}