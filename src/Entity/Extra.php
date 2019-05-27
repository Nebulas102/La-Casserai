<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExtraRepository")
 */
class Extra
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
     * @ORM\OneToMany(targetEntity="App\Entity\Room", mappedBy="extra")
     */
    private $roomExtra;

    public function __construct()
    {
        $this->roomExtra = new ArrayCollection();
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
    public function getRoomExtra(): Collection
    {
        return $this->roomExtra;
    }

    public function addRoomExtra(Room $roomExtra): self
    {
        if (!$this->roomExtra->contains($roomExtra)) {
            $this->roomExtra[] = $roomExtra;
            $roomExtra->setExtra($this);
        }

        return $this;
    }

    public function removeRoomExtra(Room $roomExtra): self
    {
        if ($this->roomExtra->contains($roomExtra)) {
            $this->roomExtra->removeElement($roomExtra);
            // set the owning side to null (unless already changed)
            if ($roomExtra->getExtra() === $this) {
                $roomExtra->setExtra(null);
            }
        }

        return $this;
    }
}
