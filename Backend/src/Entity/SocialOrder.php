<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SocialOrderRepository")
 */
class SocialOrder
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
}
