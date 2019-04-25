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
    private $executionDate;


    /**
     * @ORM\Column(type="boolean")
     */
    private $hasDone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastWish;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Prisoner", inversedBy="executions")
     */
    private $prisoner;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Worker", inversedBy="execution")
     */
    private $worker;


    /**
     * Execution constructor.
     * @param \DateTime $ExecutionDate
     * @param Worker    $worker
     * @param bool      $HasDone
     * @param string    $lastWish
     * @param Prisoner  $prisoner
     */
    public function __construct(\DateTime $ExecutionDate, Worker $worker, bool $HasDone, string $lastWish, Prisoner $prisoner)
    {
        $this->executionDate = $ExecutionDate;
        $this->worker = $worker;
        $this->hasDone = $HasDone;
        $this->lastWish = $lastWish;
        $this->prisoner = $prisoner;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExecutionDate(): ?\DateTimeInterface
    {
        return $this->executionDate;
    }

    public function setExecutionDate(\DateTimeInterface $executionDate): self
    {
        $this->executionDate = $executionDate;

        return $this;
    }

    public function getHasDone(): ?bool
    {
        return $this->hasDone;
    }

    public function setHasDone(bool $hasDone): self
    {
        $this->hasDone = $hasDone;

        return $this;
    }

    public function getLastWish(): ?string
    {
        return $this->lastWish;
    }

    public function setLastWish(string $lastWish): self
    {
        $this->lastWish = $lastWish;

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

    public function getWorker(): ?Worker
    {
        return $this->worker;
    }

    public function setWorker(?Worker $worker): self
    {
        $this->worker = $worker;

        return $this;
    }
}
