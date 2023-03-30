<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Interfaces\PatientRepositoryInterface;

class DeletePatientService
{
    public function __construct(private PatientRepositoryInterface $patientRepository) {}

    public function destroyPatient(int $id)
    {
        if (!$this->patientRepository->findById($id))
            throw new NotFoundException();
        
        $this->patientRepository->delete($id);
    }
}