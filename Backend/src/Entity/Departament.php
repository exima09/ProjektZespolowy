<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DepartamentRepository")
 */
class Departament
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
    private $DepartamentName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepartamentName(): ?string
    {
        return $this->DepartamentName;
    }

    public function setDepartamentName(string $DepartamentName): self
    {
        $this->DepartamentName = $DepartamentName;

        return $this;
    }
}
