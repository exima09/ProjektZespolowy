<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MedicalOrderRepository")
 */
class MedicalOrder
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
    private $MedicalProductId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMedicalProductId(): ?int
    {
        return $this->MedicalProductId;
    }

    public function setMedicalProductId(int $MedicalProductId): self
    {
        $this->MedicalProductId = $MedicalProductId;

        return $this;
    }
}
