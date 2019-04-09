<?php
/**
 * Created by PhpStorm.
 * User: Paweł
 * Date: 09.04.2019
 * Time: 09:20
 */

namespace App\Tests\Repository;


use App\Entity\User;
use Monolog\TestCase;

class UserTest extends TestCase
{
    public function getIdTest() {
        $User = new User();
        $result = $User->getId();

        $this->assertNotNull($result);
    }

    public function setAndGetUsernameTest() {
        $User = new User();
        $User->setUsername("testUsername");
        $result = $User->getUsername();

        $this->assertNotNull($result);
        $this->assertEquals("testUsername", $result);
    }

    public function setAndGetFirstNameTest() {
        $User = new User();
        $User->setPassword("testPassword");
        $result = $User->getPassword();

        $this->assertNotNull($result);
        $this->assertEquals("testPassword", $result);
    }

    public function setAndGetRoleTest() {
        $User = new User();
        $User->setRoles("testRole");
        $result = $User->getRoles();

        $this->assertNotNull($result);
        $this->assertEquals("testRole", $result[0]);
    }
}