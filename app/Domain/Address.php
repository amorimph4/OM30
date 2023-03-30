<?php

declare(strict_types=1);

namespace App\Domain;

class Address 
{
    public function __construct(
        private string $city,
        private string $state,
        private string $neighborhood,
        private string $street,
        private int $number,
        private string $zipCode,
        private ?string $complement = null,
    ) {}

    public function getCity(): string
    {
        return $this->city;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getNeighborhood(): string
    {
        return $this->neighborhood;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    public function getComplement(): string|null
    {
        return $this->complement;
    }
}
