<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SuppliesRepository")
 */
class Supplies
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $SupplyName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSupplyName(): ?string
    {
        return $this->SupplyName;
    }

    public function setSupplyName(string $SupplyName): self
    {
        $this->SupplyName = $SupplyName;

        return $this;
    }
}
