<?php
/**
 * Created by PhpStorm.
 * User: Paweł
 * Date: 08.04.2019
 * Time: 17:08
 */

namespace App\Tests\Repository;


use App\Entity\Cell;
use Monolog\TestCase;

class CellTest extends TestCase
{
    public function getIdTest() {
        $Cell = new Cell();
        $result = $Cell->getId();

        $this->assertNotNull($result);
    }

}