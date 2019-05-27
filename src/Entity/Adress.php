<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdressRepository")
 */
class Adress
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
    private $street;

    /**
     * @ORM\Column(type="integer")
     */
    private $houseNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $zip;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Organisation", mappedBy="adress")
     */
    private $organisationsAdress;

    public function __construct()
    {
        $this->organisationsAdress = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getHouseNumber(): ?int
    {
        return $this->houseNumber;
    }

    public function setHouseNumber(int $houseNumber): self
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(string $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|Organisation[]
     */
    public function getOrganisationsAdress(): Collection
    {
        return $this->organisationsAdress;
    }

    public function addOrganisationsAdress(Organisation $organisationsAdress): self
    {
        if (!$this->organisationsAdress->contains($organisationsAdress)) {
            $this->organisationsAdress[] = $organisationsAdress;
            $organisationsAdress->setAdress($this);
        }

        return $this;
    }

    public function removeOrganisationsAdress(Organisation $organisationsAdress): self
    {
        if ($this->organisationsAdress->contains($organisationsAdress)) {
            $this->organisationsAdress->removeElement($organisationsAdress);
            // set the owning side to null (unless already changed)
            if ($organisationsAdress->getAdress() === $this) {
                $organisationsAdress->setAdress(null);
            }
        }

        return $this;
    }
}
