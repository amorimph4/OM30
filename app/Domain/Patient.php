<?php

declare(strict_types=1);

namespace App\Domain;

use DateTime;

class Patient 
{
    public function __construct(
        private string $name,
        private string $motherName,
        private DateTime $birthDate, 
        private string $cpf,
        private string $cns,
        private ?Address $address = null,
        private ?int $id = null,
        private ?string $photo = null,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getMotherName(): string
    {
        return $this->motherName;
    }

    public function getBirthDate(): DateTime
    {
        return $this->birthDate;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function getCns(): string
    {
        return $this->cns;
    }

    public function getAdrress(): Address|null
    {
        return $this->address;
    }

    public function getId(): int|null
    {
        return $this->id;
    }

    public function getPhoto(): string|null
    {
        return $this->photo;
    }
}
