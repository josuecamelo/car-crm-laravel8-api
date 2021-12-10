<?php

namespace App\Http\Controllers;

use App\Models\Vehicle_brand;
use App\Models\Vehicle_car_steering;
use App\Models\Vehicle_carcolor;
use App\Models\Vehicle_cubiccms;
use App\Models\Vehicle_doors;
use App\Models\Vehicle_exchange;
use App\Models\Vehicle_features;
use App\Models\Vehicle_financial;
use App\Models\Vehicle_fuel;
use App\Models\Vehicle_gearbox;
use App\Models\Vehicle_model;
use App\Models\Vehicle_motorpower;
use App\Models\Vehicle_regdate;
use App\Models\Vehicle_type;
use App\Models\Vehicle_version;
use App\Models\VehicleBrand;
use App\Models\VehicleCarSteering;
use App\Models\VehicleColor;
use App\Models\VehicleCubiccms;
use App\Models\VehicleDoor;
use App\Models\VehicleExchange;
use App\Models\VehicleFeature;
use App\Models\VehicleFinancial;
use App\Models\VehicleFuel;
use App\Models\VehicleGearbox;
use App\Models\VehicleModel;
use App\Models\VehicleMotorPower;
use App\Models\VehicleRegDate;
use App\Models\VehicleType;
use App\Models\VehicleVersion;
use Illuminate\Http\Request;

class DataScraping extends Controller
{
    
    public function index($vehicle_type_id) {
        $this->marcas($vehicle_type_id);
        $this->carro();
        $this->moto();
        $this->types();
    }

    public function marcas($vehicle_type_id) {
        if($vehicle_type_id == 2020) {
            $data = json_decode( file_get_contents(public_path('2020.json')) );
            $vehicle_brand = $data[1];
        }

        if($vehicle_type_id == 2060) {
            $data = json_decode( file_get_contents(public_path('2060.json')) );
            $vehicle_brand = $data[0];
        }

        foreach($vehicle_brand->values_list as $brand) {
            VehicleBrand::firstOrCreate([
                'label' => $brand->label,
                'value' => $brand->value,
                'vehicle_type_id' => $vehicle_type_id
            ]);

            foreach($brand->values as $model ) {
                VehicleModel::firstOrCreate([
                    'brand_id' => $brand->value,
                    'label' => $model->label,
                    'value' => $model->value,
                    'vehicle_type_id' => $vehicle_type_id
                ]);

                foreach($model->values as $version) {
                    VehicleVersion::firstOrCreate([
                        'brand_id' => $brand->value,
                        'model_id' => $model->value,
                        'label' => $version->label,
                        'value' => $version->value
                    ]);
                }
            }
        }
    }

    public function carro() {
        $data = json_decode( file_get_contents(public_path('2020.json')) );

        $array = [
            [
                'data' => $data[2],
                'class' => VehicleRegDate::class
            ],
            [
                'data' => $data[3],
                'class' => VehicleGearbox::class
            ],
            [
                'data' => $data[4],
                'class' => VehicleFuel::class
            ],
            [
                'data' => $data[5],
                'class' => VehicleCarSteering::class
            ],
            [
                'data' => $data[6],
                'class' => VehicleMotorPower::class
            ],
            [
                'data' => $data[9],
                'class' => VehicleDoor::class
            ],
            [
                'data' => $data[12],
                'class' => VehicleColor::class
            ],
            [
                'data' => $data[14],
                'class' => VehicleExchange::class
            ],
            [
                'data' => $data[15],
                'class' => VehicleFinancial::class
            ]
        ];

        foreach($array as $item) {
            $item = (object) $item;

            foreach($item->data->values_list as $value) {
                $valid = $item->class::where('value', $value->value)->first();
                if(empty($valid)) {
                    $item->class::create((array) $value);
                }
            }
        }

        foreach($data[11]->values_list as $features_car) {
            $valid = VehicleFeature::where('value', $features_car->value)
                            ->where('vehicle_type_id', 2020)
                            ->first();

            $features_car->vehicle_type_id = 2020;

            if(empty($valid)) {
                VehicleFeature::create((array) $features_car);
            }
        }
    }

    public function moto() {
        $data = json_decode( file_get_contents(public_path('2060.json')) );

        foreach($data[3]->values_list as $value) {
            $valid = VehicleCubiccms::where('value', $value->value)->first();

            if(empty($valid)) {
                VehicleCubiccms::create((array) $value);
            }
        }

        foreach($data[5]->values_list as $moto_features) {
            $valid = VehicleFeature::where('value', $moto_features->value)
                            ->where('vehicle_type_id', 2060)
                            ->first();

            $moto_features->vehicle_type_id = 2060;

            if(empty($valid)) {
                VehicleFeature::create((array) $moto_features);
            }
        }
    }

    public function types() {
        $data = [
            [
                'label' => 'Carros, vans e utilitários',
                'value' => 2020
            ],
            [
                'label' => 'Motos',
                'value' => 2060
            ]
        ];

        foreach($data as $item) {
            $valid = VehicleType::where('value', $item['value'])->first();
            
            if(empty($valid)) {
                VehicleType::create($item);
            }
        }
    }
}
