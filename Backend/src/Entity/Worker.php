<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkerRepository")
 */
class Worker
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
    private $salary;

    /**
     * @ORM\Column(type="integer")
     */
    private $bonus;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFrom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SickLeave", mappedBy="worker")
     */
    private $sickLeaves;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Department", inversedBy="workers")
     */
    private $department;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="worker", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Execution", mappedBy="worker")
     */
    private $execution;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\JailJobSchedule", mappedBy="worker")
     */
    private $jailJobSchedules;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateTo;

    public function __construct()
    {
        $this->sickLeaves = new ArrayCollection();
        $this->execution = new ArrayCollection();
        $this->jailJobSchedules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSalary(): ?int
    {
        return $this->salary;
    }

    public function setSalary(int $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getBonus(): ?int
    {
        return $this->bonus;
    }

    public function setBonus(int $bonus): self
    {
        $this->bonus = $bonus;

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

    /**
     * @return Collection|SickLeave[]
     */
    public function getSickLeaves(): Collection
    {
        return $this->sickLeaves;
    }

    public function addSickLeaf(SickLeave $sickLeaf): self
    {
        if (!$this->sickLeaves->contains($sickLeaf)) {
            $this->sickLeaves[] = $sickLeaf;
            $sickLeaf->setWorker($this);
        }

        return $this;
    }

    public function removeSickLeaf(SickLeave $sickLeaf): self
    {
        if ($this->sickLeaves->contains($sickLeaf)) {
            $this->sickLeaves->removeElement($sickLeaf);
            // set the owning side to null (unless already changed)
            if ($sickLeaf->getWorker() === $this) {
                $sickLeaf->setWorker(null);
            }
        }

        return $this;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Execution[]
     */
    public function getExecution(): Collection
    {
        return $this->execution;
    }

    public function addExecution(Execution $execution): self
    {
        if (!$this->execution->contains($execution)) {
            $this->execution[] = $execution;
            $execution->setWorker($this);
        }

        return $this;
    }

    public function removeExecution(Execution $execution): self
    {
        if ($this->execution->contains($execution)) {
            $this->execution->removeElement($execution);
            // set the owning side to null (unless already changed)
            if ($execution->getWorker() === $this) {
                $execution->setWorker(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|JailJobSchedule[]
     */
    public function getJailJobSchedules(): Collection
    {
        return $this->jailJobSchedules;
    }

    public function addJailJobSchedule(JailJobSchedule $jailJobSchedule): self
    {
        if (!$this->jailJobSchedules->contains($jailJobSchedule)) {
            $this->jailJobSchedules[] = $jailJobSchedule;
            $jailJobSchedule->setWorker($this);
        }

        return $this;
    }

    public function removeJailJobSchedule(JailJobSchedule $jailJobSchedule): self
    {
        if ($this->jailJobSchedules->contains($jailJobSchedule)) {
            $this->jailJobSchedules->removeElement($jailJobSchedule);
            // set the owning side to null (unless already changed)
            if ($jailJobSchedule->getWorker() === $this) {
                $jailJobSchedule->setWorker(null);
            }
        }

        return $this;
    }

    public function getDateTo(): ?\DateTimeInterface
    {
        return $this->dateTo;
    }

    public function setDateTo(?\DateTimeInterface $dateTo): self
    {
        $this->dateTo = $dateTo;

        return $this;
    }
}
