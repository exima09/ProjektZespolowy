<?php
/**
 * Created by PhpStorm.
 * User: Paweł
 * Date: 08.04.2019
 * Time: 17:20
 */

namespace App\Tests\Repository;


use App\Entity\JailJobs;
use PHPUnit\Framework\TestCase;

class JailJobsTest extends TestCase
{
    public function getIdTest() {
        $JailJobs = new JailJobs();
        $result = $JailJobs->getId();

        $this->assertNotNull($result);
    }

    public function setAndGetJobNameTest() {
        $JailJobs = new JailJobs();
        $JailJobs->setJobName("testJobName");
        $result = $JailJobs->getJobName();

        $this->assertNotNull($result);
        $this->assertEquals("testJobName", $result);
    }
}