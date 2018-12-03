<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VisitsRepository")
 */
class Visits
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
    private $PrisonerId;

    /**
     * @ORM\Column(type="date")
     */
    private $VisitDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrisonerId(): ?int
    {
        return $this->PrisonerId;
    }

    public function setPrisonerId(int $PrisonerId): self
    {
        $this->PrisonerId = $PrisonerId;

        return $this;
    }

    public function getVisitDate(): ?\DateTimeInterface
    {
        return $this->VisitDate;
    }

    public function setVisitDate(\DateTimeInterface $VisitDate): self
    {
        $this->VisitDate = $VisitDate;

        return $this;
    }
}
