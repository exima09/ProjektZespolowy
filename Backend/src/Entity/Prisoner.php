<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 * attributes={"access_control"="is_granted('ROLE_USER')"},
 * routePrefix="/prisoner",
 * collectionOperations={
 *     "get"={
 *          "method"="GET",
 *          "path"=""
 *      }
 * },
 * itemOperations={
 *      "get"={
 *          "method"="GET",
 *          "path"="/{id}"
 *      },
 *     "patch"={
 *          "method"="PATCH",
 *          "path"="/{id}"
 *     },
 *  })
 * @ORM\Entity(repositoryClass="App\Repository\PrisonerRepository")
 */
class Prisoner
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
     * @ORM\Column(type="datetime")
     */
    private $JoinDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateOfBirth;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Visits", mappedBy="prisoner")
     */
    private $visits;

    /**
     * @ApiSubresource
     * @ORM\OneToMany(targetEntity="App\Entity\Execution", mappedBy="prisoner")
     */
    private $executions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SickLeave", mappedBy="prisoner")
     */
    private $sickLeaves;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Cell", mappedBy="prisoner", cascade={"persist", "remove"})
     */
    private $cell;

    /**
     * Prisoner constructor.
     * @param $FirstName
     * @param $LastName
     * @param $JoinDate
     * @param $DateOfBirth
     */
    public function __construct($FirstName, $LastName, $JoinDate, $DateOfBirth)
    {
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
        $this->JoinDate = $JoinDate;
        $this->DateOfBirth = $DateOfBirth;
        $this->visits = new ArrayCollection();
        $this->executions = new ArrayCollection();
        $this->sickLeaves = new ArrayCollection();
    }

    /**
     * Prisoner constructor.
     */
    public function __construct1()
    {

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

    public function getJoinDate(): ?\DateTimeInterface
    {
        return $this->JoinDate;
    }

    public function setJoinDate(\DateTimeInterface $JoinDate): self
    {
        $this->JoinDate = $JoinDate;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->DateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $DateOfBirth): self
    {
        $this->DateOfBirth = $DateOfBirth;

        return $this;
    }

    /**
     * @return Collection|Visits[]
     */
    public function getVisits(): Collection
    {
        return $this->visits;
    }

    public function addVisit(Visits $visit): self
    {
        if (!$this->visits->contains($visit)) {
            $this->visits[] = $visit;
            $visit->setPrisoner($this);
        }

        return $this;
    }

    public function removeVisit(Visits $visit): self
    {
        if ($this->visits->contains($visit)) {
            $this->visits->removeElement($visit);
            // set the owning side to null (unless already changed)
            if ($visit->getPrisoner() === $this) {
                $visit->setPrisoner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Execution[]
     */
    public function getExecutions(): Collection
    {
        return $this->executions;
    }

    public function addExecution(Execution $execution): self
    {
        if (!$this->executions->contains($execution)) {
            $this->executions[] = $execution;
            $execution->setPrisoner($this);
        }

        return $this;
    }

    public function removeExecution(Execution $execution): self
    {
        if ($this->executions->contains($execution)) {
            $this->executions->removeElement($execution);
            // set the owning side to null (unless already changed)
            if ($execution->getPrisoner() === $this) {
                $execution->setPrisoner(null);
            }
        }

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
            $sickLeaf->setPrisoner($this);
        }

        return $this;
    }

    public function removeSickLeaf(SickLeave $sickLeaf): self
    {
        if ($this->sickLeaves->contains($sickLeaf)) {
            $this->sickLeaves->removeElement($sickLeaf);
            // set the owning side to null (unless already changed)
            if ($sickLeaf->getPrisoner() === $this) {
                $sickLeaf->setPrisoner(null);
            }
        }

        return $this;
    }

    public function getCell(): ?Cell
    {
        return $this->cell;
    }

    public function setCell(?Cell $cell): self
    {
        $this->cell = $cell;

        // set (or unset) the owning side of the relation if necessary
        $newPrisoner = $cell === null ? null : $this;
        if ($newPrisoner !== $cell->getPrisoner()) {
            $cell->setPrisoner($newPrisoner);
        }

        return $this;
    }
}
