<?php
/**
 * Created by PhpStorm.
 * User: Paweł
 * Date: 09.04.2019
 * Time: 09:13
 */

namespace App\Tests\Repository;


use App\Entity\Roles;
use PHPUnit\Framework\TestCase;

class RolesTest extends TestCase
{
    public function getIdTest() {
        $Roles = new Roles();
        $result = $Roles->getId();

        $this->assertNotNull($result);
    }

    public function setAndGetRoleNameTest() {
        $Roles = new Roles();
        $Roles->setRoleName("testRoleName");
        $result = $Roles->getRoleName();

        $this->assertNotNull($result);
        $this->assertEquals("testRoleName", $result);
    }
}