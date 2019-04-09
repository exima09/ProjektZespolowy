<?php
/**
 * Created by PhpStorm.
 * User: Paweł
 * Date: 08.04.2019
 * Time: 17:00
 */

namespace App\Tests\Repository;


use App\Entity\SampleEntity;
use PHPUnit\Framework\TestCase;

class SampleEntityTest extends TestCase
{
    public function getIdTest() {
        $SampleEntity = new SampleEntity();
        $result = $SampleEntity->getId();

        $this->assertNotNull($result);
    }

    public function setAndGetFirstPropertyTest() {
        $SampleEntity = new SampleEntity();
        $SampleEntity->setFirstProperty(98765);
        $result = $SampleEntity->getFirstProperty();

        $this->assertNotNull($result);
        $this->assertEquals(98765, $result);
    }

    public function setAndGetSecondPropertyTest() {
        $SampleEntity = new SampleEntity();
        $SampleEntity->setSecondProperty("testSecondProperty");
        $result = $SampleEntity->getSecondProperty();

        $this->assertNotNull($result);
        $this->assertEquals("testSecondProperty", $result);
    }

    public function setAndGetThirdPropertyTest() {
        $SampleEntity = new SampleEntity();
        $SampleEntity->setThirdProperty("30-11-2019");
        $result = $SampleEntity->getThirdProperty();

        $this->assertNotNull($result);
        $this->assertEquals("30-11-2019", $result);
    }
}