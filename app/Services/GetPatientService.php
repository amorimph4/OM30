<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Interfaces\PatientRepositoryInterface;

class GetPatientService
{
    public function __construct(private PatientRepositoryInterface $patientRepository) {}

    public function getPatient(int $id)
    {
        return $this->patientRepository->findById($id) ?? throw new NotFoundException();
         
    }
}