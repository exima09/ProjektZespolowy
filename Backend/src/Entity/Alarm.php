<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlarmRepository")
 */
class Alarm
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateStart;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Worker", inversedBy="alarms")
     */
    private $workerStart;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateStop;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Worker", inversedBy="alarmsStop")
     */
    private $workerStop;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getWorkerStart(): ?Worker
    {
        return $this->workerStart;
    }

    public function setWorkerStart(?Worker $workerStart): self
    {
        $this->workerStart = $workerStart;

        return $this;
    }

    public function getDateStop(): ?\DateTimeInterface
    {
        return $this->dateStop;
    }

    public function setDateStop(?\DateTimeInterface $dateStop): self
    {
        $this->dateStop = $dateStop;

        return $this;
    }

    public function getWorkerStop(): ?Worker
    {
        return $this->workerStop;
    }

    public function setWorkerStop(?Worker $workerStop): self
    {
        $this->workerStop = $workerStop;

        return $this;
    }
}
