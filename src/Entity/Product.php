<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?float $stockXS = null;

    #[ORM\Column]
    private ?float $stockS = null;

    #[ORM\Column]
    private ?float $stockM = null;

    #[ORM\Column]
    private ?float $stockL = null;

    #[ORM\Column]
    private ?float $stockXL = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getStockXS(): ?float
    {
        return $this->stockXS;
    }

    public function setStockXS(float $stockXS): static
    {
        $this->stockXS = $stockXS;

        return $this;
    }

    public function getStockS(): ?float
    {
        return $this->stockS;
    }

    public function setStockS(float $stockS): static
    {
        $this->stockS = $stockS;

        return $this;
    }

    public function getStockM(): ?float
    {
        return $this->stockM;
    }

    public function setStockM(float $stockM): static
    {
        $this->stockM = $stockM;

        return $this;
    }

    public function getStockL(): ?float
    {
        return $this->stockL;
    }

    public function setStockL(float $stockL): static
    {
        $this->stockL = $stockL;

        return $this;
    }

    public function getStockXL(): ?float
    {
        return $this->stockXL;
    }

    public function setStockXL(float $stockXL): static
    {
        $this->stockXL = $stockXL;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }
}
