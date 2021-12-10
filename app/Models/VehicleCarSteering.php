<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleCarSteering extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'value',
        'created_at',
        'updated_at',
    ];
}
