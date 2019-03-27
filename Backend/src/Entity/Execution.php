<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 * attributes={"access_control"="is_granted('ROLE_USER')"},
 * routePrefix="/execution",
 * collectionOperations={
 *      "get"={
 *          "method"="GET",
 *          "path"=""
 *      },
 *     "gett"={
 *          "method"="GET",
 *          "path"="/get-date"
 *      },
 *     "post"={
 *          "method"="POST",
 *          "path"=""
 *     }
 * },
 * itemOperations={
 *"     get"={
 *          "method"="GET",
 *          "path"="/{id}"
 *      },
 *  }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ExecutionRepository")
 */
class Execution
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
    private $ExecutionDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $WorkerId;

    /**
     * @ORM\Column(type="boolean")
     */
    private $HasDone;

    /**
     * @ORM\Column(type="integer")
     */
    private $LastWishOrderId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Prisoner", inversedBy="executions")
     */
    private $prisoner;

    /**
     * Execution constructor.
     * @param $ExecutionDate
     * @param $WorkerId
     * @param $HasDone
     * @param $LastWishOrderId
     * @param $prisoner
     */
    public function __construct($ExecutionDate, $WorkerId, $HasDone, $LastWishOrderId, $prisoner)
    {
        $this->ExecutionDate = $ExecutionDate;
        $this->WorkerId = $WorkerId;
        $this->HasDone = $HasDone;
        $this->LastWishOrderId = $LastWishOrderId;
        $this->prisoner = $prisoner;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExecutionDate(): ?\DateTimeInterface
    {
        return $this->ExecutionDate;
    }

    public function setExecutionDate(\DateTimeInterface $ExecutionDate): self
    {
        $this->ExecutionDate = $ExecutionDate;

        return $this;
    }

    public function getWorkerId(): ?int
    {
        return $this->WorkerId;
    }

    public function setWorkerId(int $WorkerId): self
    {
        $this->WorkerId = $WorkerId;

        return $this;
    }

    public function getHasDone(): ?bool
    {
        return $this->HasDone;
    }

    public function setHasDone(bool $HasDone): self
    {
        $this->HasDone = $HasDone;

        return $this;
    }

    public function getLastWishOrderId(): ?int
    {
        return $this->LastWishOrderId;
    }

    public function setLastWishOrderId(int $LastWishOrderId): self
    {
        $this->LastWishOrderId = $LastWishOrderId;

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
}
