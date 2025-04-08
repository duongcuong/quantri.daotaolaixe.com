<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_plate',
        'model',
        'rank',
        'type',
        'color',
        'gptl_number',
        'gptl_expiry_date',
        'manufacture_year',
    ];
}
