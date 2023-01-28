<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DataController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'dtp'], function () {
    Route::get('districts', [DataController::class, 'districts']);
    Route::get('regions', [DataController::class, 'regions']);
    Route::get('accident_types', [DataController::class, 'accident_types']);
    Route::get('weather_conditions', [DataController::class, 'weather_conditions']);
    Route::get('road_conditions', [DataController::class, 'road_conditions']);
    Route::get('road_parts', [DataController::class, 'road_parts']);
    Route::get('road_surface', [DataController::class, 'road_surface']);
    Route::get('accidents', [DataController::class, 'accidents']);
});
Route::get('point', [DataController::class, 'point'])->name('getPoint');
