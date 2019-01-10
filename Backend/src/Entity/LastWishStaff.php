<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LastWishStaffRepository")
 */
class LastWishStaff
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
    private $LastWishStaffName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastWishStaffName(): ?string
    {
        return $this->LastWishStaffName;
    }

    public function setLastWishStaffName(string $LastWishStaffName): self
    {
        $this->LastWishStaffName = $LastWishStaffName;

        return $this;
    }
}
