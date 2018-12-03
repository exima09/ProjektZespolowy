<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExecutionRepository")
 */
class Execution
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $ExecutionDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $PrisonerId;

    /**
     * @ORM\Column(type="integer")
     */
    private $WorkerId;

    /**
     * @ORM\Column(type="boolean")
     */
    private $HasDone;

    /**
     * @ORM\Column(type="integer")
     */
    private $LastWishOrderId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExecutionDate(): ?\DateTimeInterface
    {
        return $this->ExecutionDate;
    }

    public function setExecutionDate(\DateTimeInterface $ExecutionDate): self
    {
        $this->ExecutionDate = $ExecutionDate;

        return $this;
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

    public function getWorkerId(): ?int
    {
        return $this->WorkerId;
    }

    public function setWorkerId(int $WorkerId): self
    {
        $this->WorkerId = $WorkerId;

        return $this;
    }

    public function getHasDone(): ?bool
    {
        return $this->HasDone;
    }

    public function setHasDone(bool $HasDone): self
    {
        $this->HasDone = $HasDone;

        return $this;
    }

    public function getLastWishOrderId(): ?int
    {
        return $this->LastWishOrderId;
    }

    public function setLastWishOrderId(int $LastWishOrderId): self
    {
        $this->LastWishOrderId = $LastWishOrderId;

        return $this;
    }
}
