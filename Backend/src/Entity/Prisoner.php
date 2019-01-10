<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
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
     * @ORM\Column(type="date")
     */
    private $JoinDate;

    /**
     * @ORM\Column(type="date")
     */
    private $DateOfBirdth;

    /**
     * @ORM\Column(type="integer")
     */
    private $CellId;

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

    public function getDateOfBirdth(): ?\DateTimeInterface
    {
        return $this->DateOfBirdth;
    }

    public function setDateOfBirdth(\DateTimeInterface $DateOfBirdth): self
    {
        $this->DateOfBirdth = $DateOfBirdth;

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
}
