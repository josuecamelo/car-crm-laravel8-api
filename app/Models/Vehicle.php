<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    public function vehiclePhotos() {
        return $this->hasMany(VehiclePhoto::class)->orderBy('order', 'ASC');
    }
}
