<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MedicalProductsRepository")
 */
class MedicalProducts
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
    private $MedicalProductName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMedicalProductName(): ?string
    {
        return $this->MedicalProductName;
    }

    public function setMedicalProductName(string $MedicalProductName): self
    {
        $this->MedicalProductName = $MedicalProductName;

        return $this;
    }
}
