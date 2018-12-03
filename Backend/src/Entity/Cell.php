<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CellRepository")
 */
class Cell
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
    private $PrisonerId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrisonerId(): ?int
    {
        return $this->PrisonerId;
    }

    public function setPrisonerId(int $PrisonerId): self
    {
        $this->PrisonerId = $PrisonerId;

        return $this;
    }
}
