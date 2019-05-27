<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoomRepository")
 */
class Room
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
     * @ORM\Column(type="boolean")
     */
    private $available;

    /**
     * @ORM\Column(type="integer")
     */
    private $minCap;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $maxCap;

    /**
     * @ORM\Column(type="integer")
     */
    private $beds;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Image", inversedBy="roomImage")
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Extra", inversedBy="roomExtra")
     */
    private $extra;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="roomCategory")
     */
    private $category;

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

    public function getAvailable(): ?bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): self
    {
        $this->available = $available;

        return $this;
    }

    public function getMinCap(): ?int
    {
        return $this->minCap;
    }

    public function setMinCap(int $minCap): self
    {
        $this->minCap = $minCap;

        return $this;
    }

    public function getMaxCap(): ?string
    {
        return $this->maxCap;
    }

    public function setMaxCap(string $maxCap): self
    {
        $this->maxCap = $maxCap;

        return $this;
    }

    public function getBeds(): ?int
    {
        return $this->beds;
    }

    public function setBeds(int $beds): self
    {
        $this->beds = $beds;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getExtra(): ?Extra
    {
        return $this->extra;
    }

    public function setExtra(?Extra $extra): self
    {
        $this->extra = $extra;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
