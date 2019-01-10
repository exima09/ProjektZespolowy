<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DailyWorkerScheduleRepository")
 */
class DailyWorkerSchedule
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
    private $WorkerId;

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

    public function getWorkerId(): ?int
    {
        return $this->WorkerId;
    }

    public function setWorkerId(int $WorkerId): self
    {
        $this->WorkerId = $WorkerId;

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
