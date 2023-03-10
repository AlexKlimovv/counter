<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as SymfonyConstraints;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $carBrand = null;

    #[ORM\Column(length: 100)]
    private ?string $carModel = null;

    #[ORM\Column(length: 50)]
    private ?string $regNumber = null;

    #[ORM\Column(length: 100)]
    private ?string $vin = null;

    #[ORM\Column]
    private ?int $prodYear = null;

    #[ORM\Column(length: 50)]
    private ?string $typeOfFuel = null;

    #[ORM\Column]
    private ?int $capacity = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarBrand(): ?string
    {
        return $this->carBrand;
    }

    public function setCarBrand(string $carBrand): self
    {
        $this->carBrand = $carBrand;

        return $this;
    }

    public function getCarModel(): ?string
    {
        return $this->carModel;
    }

    public function setCarModel(string $carModel): self
    {
        $this->carModel = $carModel;

        return $this;
    }

    public function getRegNumber(): ?string
    {
        return $this->regNumber;
    }

    public function setRegNumber(string $regNumber): self
    {
        $this->regNumber = $regNumber;

        return $this;
    }

    public function getVin(): ?string
    {
        return $this->vin;
    }

    public function setVin(string $vin): self
    {
        $this->vin = $vin;

        return $this;
    }

    public function getProdYear(): ?int
    {
        return $this->prodYear;
    }

    public function setProdYear(int $prodYear): self
    {
        $this->prodYear = $prodYear;

        return $this;
    }

    public function getTypeOfFuel(): ?string
    {
        return $this->typeOfFuel;
    }

    public function setTypeOfFuel(string $typeOfFuel): self
    {
        $this->typeOfFuel = $typeOfFuel;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
