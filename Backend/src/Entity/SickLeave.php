<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\SickLeaveRepository")
 */
class SickLeave
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Worker", inversedBy="sickLeaves")
     */
    private $worker;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Prisoner", inversedBy="sickLeaves")
     */
    private $prisoner;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateOfIssue;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $reason;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateStart;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateStop;


    /**
     * SickLeave constructor.
     * @param Worker      $worker
     * @param Prisoner    $prisoner
     * @param \DateTime   $dateStart
     * @param \DateTime   $dateStop
     * @param string|null $reason
     * @throws \Exception
     */
    public function __construct(Worker $worker, Prisoner $prisoner, \DateTime $dateStart, \DateTime $dateStop, string $reason = null)
    {
        $this->worker = $worker;
        $this->prisoner = $prisoner;
        $this->dateOfIssue = new \DateTime('now');
        $this->reason = $reason;
        $this->dateStart = $dateStart;
        $this->dateStop = $dateStop;
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrisoner(): ?Prisoner
    {
        return $this->prisoner;
    }

    public function setPrisoner(?Prisoner $prisoner): self
    {
        $this->prisoner = $prisoner;

        return $this;
    }

    public function getDateOfIssue(): ?\DateTimeInterface
    {
        return $this->dateOfIssue;
    }

    public function setDateOfIssue(\DateTimeInterface $dateOfIssue): self
    {
        $this->dateOfIssue = $dateOfIssue;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): self
    {
        $this->reason = $reason;

        return $this;
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

    public function getDateStop(): ?\DateTimeInterface
    {
        return $this->dateStop;
    }

    public function setDateStop(\DateTimeInterface $dateStop): self
    {
        $this->dateStop = $dateStop;

        return $this;
    }
}
