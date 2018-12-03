<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JailJobScheduleRepository")
 */
class JailJobSchedule
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
     * @ORM\Column(type="integer")
     */
    private $JobId;

    /**
     * @ORM\Column(type="float")
     */
    private $Rate;

    /**
     * @ORM\Column(type="date")
     */
    private $DateFrom;

    /**
     * @ORM\Column(type="date")
     */
    private $DateTo;

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

    public function getJobId(): ?int
    {
        return $this->JobId;
    }

    public function setJobId(int $JobId): self
    {
        $this->JobId = $JobId;

        return $this;
    }

    public function getRate(): ?float
    {
        return $this->Rate;
    }

    public function setRate(float $Rate): self
    {
        $this->Rate = $Rate;

        return $this;
    }

    public function getDateFrom(): ?\DateTimeInterface
    {
        return $this->DateFrom;
    }

    public function setDateFrom(\DateTimeInterface $DateFrom): self
    {
        $this->DateFrom = $DateFrom;

        return $this;
    }

    public function getDateTo(): ?\DateTimeInterface
    {
        return $this->DateTo;
    }

    public function setDateTo(\DateTimeInterface $DateTo): self
    {
        $this->DateTo = $DateTo;

        return $this;
    }
}
