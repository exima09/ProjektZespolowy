<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApplicationRepository")
 */
class Application
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
     * @ORM\Column(type="string", length=15)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fileUrl;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ApplicationStatus", inversedBy="applications")
     */
    private $status;

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

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFileUrl(): ?string
    {
        return $this->fileUrl;
    }

    public function setFileUrl(string $fileUrl): self
    {
        $this->fileUrl = $fileUrl;

        return $this;
    }

    public function getStatus(): ?ApplicationStatus
    {
        return $this->status;
    }

    public function setStatus(?ApplicationStatus $status): self
    {
        $this->status = $status;

        return $this;
    }
}
