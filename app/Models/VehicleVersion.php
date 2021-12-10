<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'model_id',
        'label',
        'value',
        'created_at',
        'updated_at',
        ];
}
