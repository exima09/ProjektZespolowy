<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SocialProductsRepository")
 */
class SocialProducts
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
    private $SocialProductName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSocialProductName(): ?string
    {
        return $this->SocialProductName;
    }

    public function setSocialProductName(string $SocialProductName): self
    {
        $this->SocialProductName = $SocialProductName;

        return $this;
    }
}
