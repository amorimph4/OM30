<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Domain\Address as AddressDomain;
use App\Interfaces\AddressRepositoryInterface;
use App\Models\Address;

class AddressRepository implements AddressRepositoryInterface
{
    public function create(int $patientId, AddressDomain $data): void
    {
        Address::create([
            'patient_id' => $patientId,
            'city' => $data->getCity(),
            'complement' => $data->getComplement(),
            'neighborhood' => $data->getNeighborhood(),
            'number' => $data->getNumber(),
            'state' => $data->getState(),
            'street' => $data->getStreet(),
            'zip_code' => $data->getZipCode(),
        ]);
    }

    public function update(int $patientId, AddressDomain $data): void
    {
        Address::where('patient_id', $patientId)->update([
            'city' => $data->getCity(),
            'complement' => $data->getComplement(),
            'neighborhood' => $data->getNeighborhood(),
            'number' => $data->getNumber(),
            'state' => $data->getState(),
            'street' => $data->getStreet(),
            'zip_code' => $data->getZipCode(),
        ]);
    }
}