<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Domain\Patient;

interface PatientRepositoryInterface
{
    public function list(string $search);

    public function findById(int $id): Patient|null;

    public function findByCpf(string $cpf): Patient|null;

    public function create(Patient $data): Patient;

    public function update(Patient $data): Patient;

    public function delete(int $id): void;
}
