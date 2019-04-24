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
     * @ORM\ManyToOne(targetEntity="App\Entity\Prisoner", inversedBy="jailJobSchedules")
     */
    private $prisoner;

    /**
     * @ORM\Column(type="float")
     */
    private $rate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateFrom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateTo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Worker", inversedBy="jailJobSchedules")
     */
    private $worker;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\JailJob", inversedBy="jailJobSchedule")
     */
    private $jailJob;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrisoner(): ?Prisoner
    {
        return $this->prisoner;
    }

    public function setPrisoner(?Prisoner $prisoner): self
    {
        $this->prisoner = $prisoner;

        return $this;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(float $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getDateFrom(): ?\DateTimeInterface
    {
        return $this->dateFrom;
    }

    public function setDateFrom(\DateTimeInterface $dateFrom): self
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    public function getDateTo(): ?\DateTimeInterface
    {
        return $this->dateTo;
    }

    public function setDateTo(\DateTimeInterface $dateTo): self
    {
        $this->dateTo = $dateTo;

        return $this;
    }

    public function getWorker(): ?Worker
    {
        return $this->worker;
    }

    public function setWorker(?Worker $worker): self
    {
        $this->worker = $worker;

        return $this;
    }

    public function getJailJob(): ?JailJob
    {
        return $this->jailJob;
    }

    public function setJailJob(?JailJob $jailJob): self
    {
        $this->jailJob = $jailJob;

        return $this;
    }
}
