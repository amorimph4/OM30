<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Domain\Address;

interface AddressRepositoryInterface
{
    public function create(int $patientId, Address $data): void;

    public function update(int $patientId, Address $data): void;
}
