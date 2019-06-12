<?php

namespace App\Entity;

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
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $extra_price;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getExtraPrice(): ?float
    {
        return $this->extra_price;
    }

    public function setExtraPrice(float $extra_price): self
    {
        $this->extra_price = $extra_price;

        return $this;
    }

    public function __toString()
    {
        return (string)$this->getDescription() . "\r\n €" .$this->getExtraPrice();
    }
}
