<?php

namespace App\Jobs;

use App\Domain\Patient as PatientDomain;
use App\Models\Patient;
use App\Models\Address;
use Illuminate\Bus\Queueable;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PatientsCsvProcess implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private PatientDomain $patient)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $patient = Patient::create([
            'photo' => $this->patient->getPhoto(),
            'name' => $this->patient->getName(),
            'mother_name' => $this->patient->getMotherName(),
            'birth_date' => $this->patient->getBirthDate()->format('Y-m-d'),
            'cpf' => $this->patient->getCpf(),
            'cns' => $this->patient->getCns()
        ]);

        if ($this->patient->getAdrress()) {
            Address::create([
                'patient_id' => $patient->id,
                'city' => $this->patient->getAdrress()->getCity(),
                'complement' => $this->patient->getAdrress()->getComplement(),
                'neighborhood' => $this->patient->getAdrress()->getNeighborhood(),
                'number' => $this->patient->getAdrress()->getNumber(),
                'state' => $this->patient->getAdrress()->getState(),
                'street' => $this->patient->getAdrress()->getStreet(),
                'zip_code' => $this->patient->getAdrress()->getZipCode(),
            ]);
        }
    }
}
