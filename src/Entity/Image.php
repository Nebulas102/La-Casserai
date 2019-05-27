<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Room", mappedBy="image")
     */
    private $roomImage;

    public function __construct()
    {
        $this->roomImage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Room[]
     */
    public function getRoomImage(): Collection
    {
        return $this->roomImage;
    }

    public function addRoomImage(Room $roomImage): self
    {
        if (!$this->roomImage->contains($roomImage)) {
            $this->roomImage[] = $roomImage;
            $roomImage->setImage($this);
        }

        return $this;
    }

    public function removeRoomImage(Room $roomImage): self
    {
        if ($this->roomImage->contains($roomImage)) {
            $this->roomImage->removeElement($roomImage);
            // set the owning side to null (unless already changed)
            if ($roomImage->getImage() === $this) {
                $roomImage->setImage(null);
            }
        }

        return $this;
    }
}
