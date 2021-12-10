<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'label',
        'value',
        'vehicle_type_id',
        'created_at',
        'updated_at',
    ];
}
