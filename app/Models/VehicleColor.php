<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleColor extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'value',
        'vehicle_type_id',
        'created_at',
        'updated_at',
        ];
}
