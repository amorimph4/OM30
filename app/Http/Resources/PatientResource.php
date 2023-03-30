<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this->resource->getId(),
            'photo' => $this->resource->getPhoto(),
            'name' => $this->resource->getName(),
            'mother_name' => $this->resource->getMotherName(),
            'birth_date' => $this->resource->getBirthDate()->format('Y-m-d'),
            'cpf' => $this->resource->getCpf(),
            'cns' => $this->resource->getCns(),
            'address' => $this->resource->getAdrress() ? [
                'city' => $this->resource->getAdrress()->getCity(),
                'state' => $this->resource->getAdrress()->getState(),
                'neighborhood' => $this->resource->getAdrress()->getNeighborhood(),
                'street' => $this->resource->getAdrress()->getStreet(),
                'number' => $this->resource->getAdrress()->getNumber(),
                'zip_code' => $this->resource->getAdrress()->getZipCode(),
                'complement' => $this->resource->getAdrress()->getComplement(),
            ] : null
        ];
    }
}
