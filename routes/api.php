<?php
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'store']);

Route::apiResources([
    'vehicles' => VehiclesController::class
]);

Route::group(['prefix' => 'webservice'], function() {
    Route::post('cep', [WebserviceController::class, 'cep']);
});