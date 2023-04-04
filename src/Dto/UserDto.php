<?php

namespace App\Dto;

use App\Entity\User;
use Symfony\Component\Validator\Constraints as SymfonyConstraints;

class UserDto
{
    #[SymfonyConstraints\NotBlank(allowNull: false)]
    #[SymfonyConstraints\Length(min: 2, max: 30)]
    public ?string $name = null;

    #[SymfonyConstraints\NotBlank(allowNull: false)]
    #[SymfonyConstraints\Length(min: 2, max: 30)]
    public ?string $lastname = null;

    #[SymfonyConstraints\NotBlank(allowNull: false)]
    #[SymfonyConstraints\Length(min: 13, max: 13)]
    public ?string $phoneNum = null;
}