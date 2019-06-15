<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
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
     * @ORM\Column(type="datetime")
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Alarm", mappedBy="workerStart")
     */
    private $alarms;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Alarm", mappedBy="workerStop")
     */
    private $alarmsStop;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\News", mappedBy="worker")
     */
    private $news;

    public function __construct(int $salary, int $bonus, User $user, Department $department)
    {
        $this->salary = $salary;
        $this->bonus = $bonus;
        $this->user = $user;
        $this->department = $department;
        try {
            $this->dateFrom = new \DateTime('now');
        } catch (\Exception $e) {
        }
        $this->sickLeaves = new ArrayCollection();
        $this->execution = new ArrayCollection();
        $this->jailJobSchedules = new ArrayCollection();
        $this->alarms = new ArrayCollection();
        $this->alarmsStop = new ArrayCollection();
        $this->news = new ArrayCollection();
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

    /**
     * @return Collection|Alarm[]
     */
    public function getAlarms(): Collection
    {
        return $this->alarms;
    }

    public function addAlarm(Alarm $alarm): self
    {
        if (!$this->alarms->contains($alarm)) {
            $this->alarms[] = $alarm;
            $alarm->setWorkerStart($this);
        }

        return $this;
    }

    public function removeAlarm(Alarm $alarm): self
    {
        if ($this->alarms->contains($alarm)) {
            $this->alarms->removeElement($alarm);
            // set the owning side to null (unless already changed)
            if ($alarm->getWorkerStart() === $this) {
                $alarm->setWorkerStart(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Alarm[]
     */
    public function getAlarmsStop(): Collection
    {
        return $this->alarmsStop;
    }

    public function addAlarmsStop(Alarm $alarmsStop): self
    {
        if (!$this->alarmsStop->contains($alarmsStop)) {
            $this->alarmsStop[] = $alarmsStop;
            $alarmsStop->setWorkerStop($this);
        }

        return $this;
    }

    public function removeAlarmsStop(Alarm $alarmsStop): self
    {
        if ($this->alarmsStop->contains($alarmsStop)) {
            $this->alarmsStop->removeElement($alarmsStop);
            // set the owning side to null (unless already changed)
            if ($alarmsStop->getWorkerStop() === $this) {
                $alarmsStop->setWorkerStop(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|News[]
     */
    public function getNews(): Collection
    {
        return $this->news;
    }

    public function addNews(News $news): self
    {
        if (!$this->news->contains($news)) {
            $this->news[] = $news;
            $news->setWorker($this);
        }

        return $this;
    }

    public function removeNews(News $news): self
    {
        if ($this->news->contains($news)) {
            $this->news->removeElement($news);
            // set the owning side to null (unless already changed)
            if ($news->getWorker() === $this) {
                $news->setWorker(null);
            }
        }

        return $this;
    }
}
