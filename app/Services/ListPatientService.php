<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\PatientRepositoryInterface;

class ListPatientService
{
    public function __construct(private PatientRepositoryInterface $patientRepository) {}

    public function listPatients(string $search)
    {
        return $this->patientRepository->list($search);
    }
}