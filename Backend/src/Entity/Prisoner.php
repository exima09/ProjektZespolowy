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
     * @ORM\Column(type="integer")
     */
    private $CellId;

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
     * Prisoner constructor.
     * @param $FirstName
     * @param $LastName
     * @param $JoinDate
     * @param $DateOfBirth
     * @param $CellId
     */
    public function __construct($FirstName, $LastName, $JoinDate, $DateOfBirth, $CellId)
    {
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
        $this->JoinDate = $JoinDate;
        $this->DateOfBirth = $DateOfBirth;
        $this->CellId = $CellId;
        $this->visits = new ArrayCollection();
        $this->executions = new ArrayCollection();
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

    public function getCellId(): ?int
    {
        return $this->CellId;
    }

    public function setCellId(int $CellId): self
    {
        $this->CellId = $CellId;

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
}
