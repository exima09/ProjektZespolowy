<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JailJobRepository")
 */
class JailJob
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $jobName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\JailJobSchedule", mappedBy="jailJob")
     */
    private $jailJobSchedule;

    public function __construct()
    {
        $this->jailJobSchedule = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJobName(): ?string
    {
        return $this->jobName;
    }

    public function setJobName(string $jobName): self
    {
        $this->jobName = $jobName;

        return $this;
    }

    /**
     * @return Collection|JailJobSchedule[]
     */
    public function getJailJobSchedule(): Collection
    {
        return $this->jailJobSchedule;
    }

    public function addJailJobSchedule(JailJobSchedule $jailJobSchedule): self
    {
        if (!$this->jailJobSchedule->contains($jailJobSchedule)) {
            $this->jailJobSchedule[] = $jailJobSchedule;
            $jailJobSchedule->setJailJob($this);
        }

        return $this;
    }

    public function removeJailJobSchedule(JailJobSchedule $jailJobSchedule): self
    {
        if ($this->jailJobSchedule->contains($jailJobSchedule)) {
            $this->jailJobSchedule->removeElement($jailJobSchedule);
            // set the owning side to null (unless already changed)
            if ($jailJobSchedule->getJailJob() === $this) {
                $jailJobSchedule->setJailJob(null);
            }
        }

        return $this;
    }
}
