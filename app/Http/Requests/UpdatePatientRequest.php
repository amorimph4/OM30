<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Domain\Address;
use App\Domain\Patient;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Datetime;

class UpdatePatientRequest extends FormRequest
{
    public function __construct()
    {
    }

    public function rules()
    {
        return [
            'photo' => 'image',
            'name' => 'required|string|min:1|max:180',
            'mother_name' => 'required|string|min:1|max:180',
            'birth_date' => 'required|string|min:1|max:180',
            'cpf' => 'required|regex:/^[0-9]/|min:11|max:11',
            'cns' => 'required|numeric',
            'address.city' => 'required|string|min:3',
            'address.complement' => 'string|nullable',
            'address.neighborhood' => 'required|string|min:1',
            'address.number' => 'required|numeric|min:1|max:999999',
            'address.state' => 'required|string|min:2|max:2',
            'address.street' => 'required|string|min:1',
            'address.zip_code' => 'required|string|min:8|max:8',
        ];
    }

    public function toDomain(): Patient
    {
        $data = $this->validated();

        return new Patient(
            $data['name'],
            $data['mother_name'],
            new DateTime($data['birth_date']),
            $data['cpf'],
            $data['cns'],
            new Address(
                $data['address']['city'],
                $data['address']['state'],
                $data['address']['neighborhood'],
                $data['address']['street'],
                (int) $data['address']['number'],
                $data['address']['zip_code'],
                $data['address']['complement'],
            ),
            (int) $this->route('id'),
            $this->generateFilePath()
        );
    }

    private function generateFilePath() {
        if ($this->hasFile('photo') && $this->file('photo')->isValid()) {
            return $this->photo->store($this->photo->path().$this->photo->extension(), 'public');
        }

        return null;
    }

    protected function failedValidation(Validator $validator): void
    {

        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            response()->json(
                ['message' => $errors],
                JsonResponse::HTTP_BAD_REQUEST
            )
        );
    }
}
