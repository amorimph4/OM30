<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'city',
        'complement',
        'neighborhood',
        'number',
        'state',
        'street',
        'zip_code',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
