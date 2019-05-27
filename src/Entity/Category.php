<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $addPrice;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Room", mappedBy="category")
     */
    private $roomCategory;

    public function __construct()
    {
        $this->roomCategory = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAddPrice(): ?float
    {
        return $this->addPrice;
    }

    public function setAddPrice(float $addPrice): self
    {
        $this->addPrice = $addPrice;

        return $this;
    }

    /**
     * @return Collection|Room[]
     */
    public function getRoomCategory(): Collection
    {
        return $this->roomCategory;
    }

    public function addRoomCategory(Room $roomCategory): self
    {
        if (!$this->roomCategory->contains($roomCategory)) {
            $this->roomCategory[] = $roomCategory;
            $roomCategory->setCategory($this);
        }

        return $this;
    }

    public function removeRoomCategory(Room $roomCategory): self
    {
        if ($this->roomCategory->contains($roomCategory)) {
            $this->roomCategory->removeElement($roomCategory);
            // set the owning side to null (unless already changed)
            if ($roomCategory->getCategory() === $this) {
                $roomCategory->setCategory(null);
            }
        }

        return $this;
    }
}
