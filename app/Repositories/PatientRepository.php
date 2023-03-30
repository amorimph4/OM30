<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Domain\Address;
use App\Domain\Patient as DomainPatient;
use App\Interfaces\PatientRepositoryInterface;
use App\Models\Patient;
use DateTime;

class PatientRepository implements PatientRepositoryInterface
{
    public function list(string $search)
    {
        return $search ? Patient::where('cpf', $search)
            ->orWhere('name', $search)
            ->with('address')
            ->paginate() : Patient::with('address')->paginate();
    }

    public function findById(int $id): DomainPatient|null
    {
        $patient = Patient::where('id', $id)->with('address')->first();
        return $patient ? $this->fromEntityToDomain($patient) : $patient;
    }

    public function findByCpf(string $cpf): DomainPatient|null
    {
        return $this->fromEntityToDomain(
            Patient::where('cpf', $cpf)->with('address')->first()
        );
    }

    public function create(DomainPatient $data): DomainPatient
    {
        return $this->fromEntityToDomain(
            Patient::create([
                'photo' => $data->getPhoto(),
                'name' => $data->getName(),
                'mother_name' => $data->getMotherName(),
                'birth_date' => $data->getBirthDate()->format('Y-m-d'),
                'cpf' => $data->getCpf(),
                'cns' => $data->getCns()
            ])
        );
    }

    public function update(DomainPatient $data): DomainPatient
    {
        return $this->fromEntityToDomain(
            Patient::where('id', $data->getId())->update([
                'photo' => $data->getPhoto(),
                'name' => $data->getName(),
                'mother_name' => $data->getMotherName(),
                'birth_date' => $data->getBirthDate()->format('Y-m-d'),
                'cpf' => $data->getCpf(),
                'cns' => $data->getCns()
            ])
        );
    }

    public function delete(int $id): void
    {
        Patient::where('id', $id)->with('address')->delete();
    }

    private function fromEntityToDomain(Patient $patient): DomainPatient
    {
        $address = $patient->address ? new Address(
            $patient->address->city,
            $patient->address->state,
            $patient->address->neighborhood,
            $patient->address->street,
            $patient->address->number,
            $patient->address->zip_code,
            $patient->address->complement
        ) : null;

        return new DomainPatient(
            $patient->name,
            $patient->mother_name,
            new DateTime($patient->birth_date),
            $patient->cpf,
            $patient->cns,
            $address,
            $patient->id,
            $patient->photo,
        );
    }
}