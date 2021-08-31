<?php

namespace App\Entity;

use App\Repository\PlatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlatRepository::class)
 */
class Plat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $img;

    /**
     * @ORM\ManyToMany(targetEntity=Restaurant::class, inversedBy="plats")
     */
    private $Plats;

    /**
     * @ORM\ManyToMany(targetEntity=Order::class, inversedBy="plats")
     */
    private $Orders;

    public function __construct()
    {
        $this->Plats = new ArrayCollection();
        $this->Orders = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    /**
     * @return Collection|Restaurant[]
     */
    public function getPlats(): Collection
    {
        return $this->Plats;
    }

    public function addPlat(Restaurant $plat): self
    {
        if (!$this->Plats->contains($plat)) {
            $this->Plats[] = $plat;
        }

        return $this;
    }

    public function removePlat(Restaurant $plat): self
    {
        $this->Plats->removeElement($plat);

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->Orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->Orders->contains($order)) {
            $this->Orders[] = $order;
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        $this->Orders->removeElement($order);

        return $this;
    }
}
