<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SupplyOrderRepository")
 */
class SupplyOrder
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $SupplyId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSupplyId(): ?int
    {
        return $this->SupplyId;
    }

    public function setSupplyId(int $SupplyId): self
    {
        $this->SupplyId = $SupplyId;

        return $this;
    }
}
