<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListPatientRequest extends FormRequest
{
    public function rules()
    {
        return [
            'search' => 'string',
        ];
    }

    public function getSearch()
    {
        return $this->get('search') ?? '';
    }
}
