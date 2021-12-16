<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tag_id',
        'zipcode',
        'cidade',
        'city_url',
        'uf',
        'uf_url',
        'vehicle_type',
        'vehicle_brand',
        'vehicle_model',
        'vehicle_version',
        'vehicle_regdate',
        'vehicle_gearbox',
        'vehicle_fuel',
        'vehicle_steering',
        'vehicle_motorpower',
        'vehicle_doors',
        'vehicle_color',
        'vehicle_cubiccms',
        'vehicle_owner',
        'vehicle_mileage',
        'vehicle_moto_features',
        'vehicle_financial',
        'vehicle_price',
        'title',
        'description',
        'status',
    ];

    public function vehiclePhotos()
    {
        return $this->hasMany(VehiclePhoto::class)->orderBy('order', 'ASC');
    }
}
