<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\MaxDepth;

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
    private $firstName;

    /**
     * @ORM\Column(type="string", length=50)
    */
    private $lastName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $joinDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateOfBirth;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Visits", mappedBy="prisoner")
     * @MaxDepth(2)
     */
    private $visits;

    /**
     * @ApiSubresource
     * @ORM\OneToMany(targetEntity="App\Entity\Execution", mappedBy="prisoner")
     * @MaxDepth(2)
     */
    private $executions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SickLeave", mappedBy="prisoner")
     * @MaxDepth(2)
     */
    private $sickLeaves;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Cell", mappedBy="prisoner", cascade={"persist", "remove"})
     * @MaxDepth(2)
     */
    private $cell;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\JailJobSchedule", mappedBy="prisoner")
     *
     */
    private $jailJobSchedules;

    /**
     * Prisoner constructor.
     * @param string    $firstName
     * @param string    $lastName
     * @param \DateTime $joinDate
     * @param \DateTime $dateOfBirth
     */
    public function __construct(string $firstName, string $lastName, \DateTime $joinDate, \DateTime $dateOfBirth)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->joinDate = $joinDate;
        $this->dateOfBirth = $dateOfBirth;
        $this->visits = new ArrayCollection();
        $this->executions = new ArrayCollection();
        $this->sickLeaves = new ArrayCollection();
        $this->jailJobSchedules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getJoinDate(): ?\DateTimeInterface
    {
        return $this->joinDate;
    }

    public function setJoinDate(\DateTimeInterface $joinDate): self
    {
        $this->joinDate = $joinDate;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

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
            $jailJobSchedule->setPrisoner($this);
        }

        return $this;
    }

    public function removeJailJobSchedule(JailJobSchedule $jailJobSchedule): self
    {
        if ($this->jailJobSchedules->contains($jailJobSchedule)) {
            $this->jailJobSchedules->removeElement($jailJobSchedule);
            // set the owning side to null (unless already changed)
            if ($jailJobSchedule->getPrisoner() === $this) {
                $jailJobSchedule->setPrisoner(null);
            }
        }

        return $this;
    }
}
