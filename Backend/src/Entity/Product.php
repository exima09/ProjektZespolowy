<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeOfProducts", inversedBy="products")
     */
    private $typeOfProduct;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LacksProducts", mappedBy="product")
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

    public function getTypeOfProduct(): ?TypeOfProducts
    {
        return $this->typeOfProduct;
    }

    public function setTypeOfProduct(?TypeOfProducts $typeOfProduct): self
    {
        $this->typeOfProduct = $typeOfProduct;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $lacksProduct->setProduct($this);
        }

        return $this;
    }

    public function removeLacksProduct(LacksProducts $lacksProduct): self
    {
        if ($this->lacksProducts->contains($lacksProduct)) {
            $this->lacksProducts->removeElement($lacksProduct);
            // set the owning side to null (unless already changed)
            if ($lacksProduct->getProduct() === $this) {
                $lacksProduct->setProduct(null);
            }
        }

        return $this;
    }
}
