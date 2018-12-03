<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LastWishOrderRepository")
 */
class LastWishOrder
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
    private $LastWishStaffId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastWishStaffId(): ?int
    {
        return $this->LastWishStaffId;
    }

    public function setLastWishStaffId(int $LastWishStaffId): self
    {
        $this->LastWishStaffId = $LastWishStaffId;

        return $this;
    }
}
