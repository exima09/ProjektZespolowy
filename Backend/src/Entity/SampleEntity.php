<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SampleEntityRepository")
 */
class SampleEntity
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
    private $firstProperty;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $secondProperty;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $thirdProperty;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstProperty(): ?int
    {
        return $this->firstProperty;
    }

    public function setFirstProperty(int $firstProperty): self
    {
        $this->firstProperty = $firstProperty;

        return $this;
    }

    public function getSecondProperty(): ?string
    {
        return $this->secondProperty;
    }

    public function setSecondProperty(?string $secondProperty): self
    {
        $this->secondProperty = $secondProperty;

        return $this;
    }

    public function getThirdProperty(): ?\DateTimeInterface
    {
        return $this->thirdProperty;
    }

    public function setThirdProperty(?\DateTimeInterface $thirdProperty): self
    {
        $this->thirdProperty = $thirdProperty;

        return $this;
    }
    //
}
