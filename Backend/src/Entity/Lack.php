<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LackRepository")
 */
class Lack
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
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LacksProducts", mappedBy="lack")
     */
    private $lacksProducts;

    public function __construct()
    {
        $this->lacksProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|LacksProducts[]
     */
    public function getLacksProducts(): Collection
    {
        return $this->lacksProducts;
    }

    public function addLacksProduct(LacksProducts $lacksProduct): self
    {
        if (!$this->lacksProducts->contains($lacksProduct)) {
            $this->lacksProducts[] = $lacksProduct;
            $lacksProduct->setLack($this);
        }

        return $this;
    }

    public function removeLacksProduct(LacksProducts $lacksProduct): self
    {
        if ($this->lacksProducts->contains($lacksProduct)) {
            $this->lacksProducts->removeElement($lacksProduct);
            // set the owning side to null (unless already changed)
            if ($lacksProduct->getLack() === $this) {
                $lacksProduct->setLack(null);
            }
        }

        return $this;
    }
}
