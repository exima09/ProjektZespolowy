<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LacksProductsRepository")
 */
class LacksProducts
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="lacksProducts")
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lack", inversedBy="lacksProducts")
     */
    private $lack;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getLack(): ?Lack
    {
        return $this->lack;
    }

    public function setLack(?Lack $lack): self
    {
        $this->lack = $lack;

        return $this;
    }
}
