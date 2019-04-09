<?php
/**
 * Created by PhpStorm.
 * User: Paweł
 * Date: 08.04.2019
 * Time: 17:13
 */

namespace App\Tests\Repository;


use App\Entity\Departament;
use Monolog\TestCase;

class DepartamentTest extends TestCase
{
    public function getIdTest() {
        $Departament = new Departament();
        $result = $Departament->getId();

        $this->assertNotNull($result);
    }

    public function setAndGetFirstNameTest() {
        $Departament = new Departament();
        $Departament->setDepartamentName("testName");
        $result = $Departament->getDepartamentName();

        $this->assertNotNull($result);
        $this->assertEquals("testName", $result);
    }

}