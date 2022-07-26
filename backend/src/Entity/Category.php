<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
//    const FILM = 0;
//    const CODE = 1;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
//     * @Groups({"product_list:read", "category_list:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
//     * @Groups({"product_list:read", "category_list:read"})
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, mappedBy="categories")
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        $this->products->removeElement($product);

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            "name" => $this->getName(),
        ];
    }

    public function __toString()
    {
        return $this->getId().' '.$this->getName();
    }
}
