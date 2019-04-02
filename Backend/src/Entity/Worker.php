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
     * @ORM\Column(type="string", length=50)
     */
    private $FirstName;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $LastName;

    /**
     * @ORM\Column(type="integer")
     */
    private $DepartamentId;

    /**
     * @ORM\Column(type="integer")
     */
    private $Salary;

    /**
     * @ORM\Column(type="integer")
     */
    private $Bonus;

    /**
     * @ORM\Column(type="date")
     */
    private $DateFrom;

    /**
     * @ORM\Column(type="date")
     */
    private $DateTo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SickLeave", mappedBy="worker")
     */
    private $sickLeaves;

    public function __construct()
    {
        $this->sickLeaves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getDepartamentId(): ?int
    {
        return $this->DepartamentId;
    }

    public function setDepartamentId(int $DepartamentId): self
    {
        $this->DepartamentId = $DepartamentId;

        return $this;
    }

    public function getSalary(): ?int
    {
        return $this->Salary;
    }

    public function setSalary(int $Salary): self
    {
        $this->Salary = $Salary;

        return $this;
    }

    public function getBonus(): ?int
    {
        return $this->Bonus;
    }

    public function setBonus(int $Bonus): self
    {
        $this->Bonus = $Bonus;

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
}
