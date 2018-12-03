<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
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
    private $RoleId;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoleId(): ?int
    {
        return $this->RoleId;
    }

    public function setRoleId(int $RoleId): self
    {
        $this->RoleId = $RoleId;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }
}
