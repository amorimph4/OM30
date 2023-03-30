<?php

declare(strict_types=1);

namespace App\Services;

use App\Domain\Patient;
use App\Exceptions\NotFoundException;
use App\Interfaces\PatientRepositoryInterface;
use App\Interfaces\AddressRepositoryInterface;

class UpdatePatientService
{
    public function __construct(
        private PatientRepositoryInterface $patientRepository,
        private AddressRepositoryInterface $adrressRepository,
    ) {}

    public function update(Patient $patient)
    {
        if(!$this->patientRepository->findById($patient->getId())) {
            throw new NotFoundException();
        }

        $this->patientRepository->update($patient);
        $this->adrressRepository->update($patient->getId(), $patient->getAdrress());
    }
}
