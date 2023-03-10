<?php

namespace App\Dto;

use App\Entity\Car;
use Symfony\Component\Validator\Constraints as SymfonyConstraints;
class CarDto
{
    #[SymfonyConstraints\NotBlank(allowNull: false)]
    #[SymfonyConstraints\Length(min: 2, max: 15)]
    public ?string $carBrand = null;

    #[SymfonyConstraints\NotBlank(allowNull: false)]
    #[SymfonyConstraints\Length(min: 2, max: 15)]
    public ?string $carModel = null;

    #[SymfonyConstraints\NotBlank(allowNull: false)]
    #[SymfonyConstraints\Length(min: 7, max: 8)]
    public ?string $regNumber = null;

    #[SymfonyConstraints\NotNull()]
    #[SymfonyConstraints\Length(exactly: 17)]
    public ?string $vin = null;

    #[SymfonyConstraints\Range(min: 1930, max: 2030)]
    public ?int $prodYear = null;

    #[SymfonyConstraints\Choice(choices: Car::FUEL_TYPES)]
    public ?string $typeOfFuel = null;

    #[SymfonyConstraints\Range(min: 500, max: 15000)]
    public ?int $capacity = null;

}