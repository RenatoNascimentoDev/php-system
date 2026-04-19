<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'description',
        'customer_name',
        'product',
        'price',
        'quantity',
        'total',
    ];
}
