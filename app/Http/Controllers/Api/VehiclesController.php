<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleCarSteering;
use App\Models\VehicleColor;
use App\Models\VehicleCubiccms;
use App\Models\VehicleDoor;
use App\Models\VehicleExchange;
use App\Models\VehicleFeature;
use App\Models\VehicleFinancial;
use App\Models\VehicleFuel;
use App\Models\VehicleGearbox;
use App\Models\VehicleMotorPower;
use App\Models\VehicleRegDate;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehiclesController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth()->guard('api')->user();
    }

    private function getData()
    {
        return [
            'vehicle_types' => VehicleType::all(),
            'regdate' => VehicleRegDate::orderBy('label', 'ASC')->get(),
            'gearbox' => VehicleGearbox::all(),
            'fuel' => VehicleFuel::all(),
            'car_steering' => VehicleCarSteering::all(),
            'motorpower' => VehicleMotorPower::all(),
            'doors' => VehicleDoor::all(),
            'features' => VehicleFeature::all(),
            'carcolor' => VehicleColor::all(),
            'exchange' => VehicleExchange::all(),
            'financial' => VehicleFinancial::all(),
            'cubiccms' => VehicleCubiccms::all(),
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehicle = Vehicle::with('vehiclePhotos')
            ->firstOrCreate([
                'user_id' => $this->user->id,
                'status' => 0
            ]);

        return array_merge(['vehicle' => $vehicle], $this->getData());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
