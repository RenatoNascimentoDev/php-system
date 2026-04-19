<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    protected $fillable = [
        'name',
        'cnpj',
        'cep',
        'state',
        'city',
        'district',
        'street',
        'number',
        'complement',
    ];
}
