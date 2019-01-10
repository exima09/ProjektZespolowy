<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SocialProductLackRepository")
 */
class SocialProductLack
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
    private $SocialProductId;

    /**
     * @ORM\Column(type="integer")
     */
    private $NumberOfLack;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSocialProductId(): ?int
    {
        return $this->SocialProductId;
    }

    public function setSocialProductId(int $SocialProductId): self
    {
        $this->SocialProductId = $SocialProductId;

        return $this;
    }

    public function getNumberOfLack(): ?int
    {
        return $this->NumberOfLack;
    }

    public function setNumberOfLack(int $NumberOfLack): self
    {
        $this->NumberOfLack = $NumberOfLack;

        return $this;
    }
}
