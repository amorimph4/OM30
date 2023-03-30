<?php

declare(strict_types=1);

namespace App\Services;

use App\Domain\Patient;
use App\Interfaces\PatientRepositoryInterface;
use App\Interfaces\AddressRepositoryInterface;

class CreatePatientService
{
    public function __construct(
        private PatientRepositoryInterface $patientRepository,
        private AddressRepositoryInterface $adrressRepository,
    ) {}

    public function create(Patient $patient)
    {
        $result = $this->patientRepository->create($patient);
        $this->adrressRepository->create($result->getId(), $patient->getAdrress());
    }
}
