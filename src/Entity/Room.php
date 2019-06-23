<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="rooms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type_id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Image")
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Extra")
     */
    private $extra;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $roomname;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="room")
     */
    private $ReservatonRoom;

    /**
     * @ORM\Column(type="float")
     */
    private $occupants;

    public function __construct()
    {
        $this->image = new ArrayCollection();
        $this->extra = new ArrayCollection();
        $this->ReservatonRoom = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTypeId(): ?Type
    {
        return $this->type_id;
    }

    public function setTypeId(?Type $type_id): self
    {
        $this->type_id = $type_id;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImage(): Collection
    {
        return $this->image;
    }
    public function addImage(Image $image): self
    {
        if (!$this->image->contains($image)) {
            $this->image[] = $image;
        }
        return $this;
    }
    public function removeImage(Image $image): self
    {
        if ($this->image->contains($image)) {
            $this->image->removeElement($image);
        }
        return $this;
    }

    /**
     * @return Collection|Extra[]
     */
    public function getExtra(): Collection
    {
        return $this->extra;
    }
    public function addExtra(Extra $extra): self
    {
        if (!$this->extra->contains($extra)) {
            $this->extra[] = $extra;
        }
        return $this;
    }
    public function removeExtra(Extra $extra): self
    {
        if ($this->extra->contains($extra)) {
            $this->extra->removeElement($extra);
        }
        return $this;
    }

    public function getRoomname(): ?string
    {
        return $this->roomname;
    }

    public function setRoomname(?string $roomname): self
    {
        $this->roomname = $roomname;

        return $this;
    }


    public function __toString()
    {
        return (string)$this->getId();
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservatonRoom(): Collection
    {
        return $this->ReservatonRoom;
    }

    public function addReservatonRoom(Reservation $reservatonRoom): self
    {
        if (!$this->ReservatonRoom->contains($reservatonRoom)) {
            $this->ReservatonRoom[] = $reservatonRoom;
            $reservatonRoom->setRoom($this);
        }

        return $this;
    }

    public function removeReservatonRoom(Reservation $reservatonRoom): self
    {
        if ($this->ReservatonRoom->contains($reservatonRoom)) {
            $this->ReservatonRoom->removeElement($reservatonRoom);
            // set the owning side to null (unless already changed)
            if ($reservatonRoom->getRoom() === $this) {
                $reservatonRoom->setRoom(null);
            }
        }

        return $this;
    }

    public function getOccupants(): ?float
    {
        return $this->occupants;
    }

    public function setOccupants(float $occupants): self
    {
        $this->occupants = $occupants;

        return $this;
    }
}
