<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetroleumDerivatesController;
use App\Http\Controllers\ElectricalEnergyController;
use App\Http\Controllers\TravelsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/petroleum', PetroleumDerivatesController::class);
Route::post('/petroleum/combustible',[App\Http\Controllers\PetroleumDerivatesController::class,'storeCombustible']);
Route::post('/petroleum/oil',[App\Http\Controllers\PetroleumDerivatesController::class,'storeOil']);
Route::post('/petroleum/other',[App\Http\Controllers\PetroleumDerivatesController::class,'store']);
Route::put('/petroleum/update',[App\Http\Controllers\PetroleumDerivatesController::class,'update']);
Route::get('/petroleum/anualcombustible/{year}',[App\Http\Controllers\PetroleumDerivatesController::class,'anualCombustible']);
Route::get('/petroleum/monthcombustible/{month}',[App\Http\Controllers\PetroleumDerivatesController::class,'monthCombustible']);
Route::get('/petroleum/mayorconsumer/{month}',[App\Http\Controllers\PetroleumDerivatesController::class,'ratedConsumer']);
Route::get('/petroleum/electricvscombustible/{month}',[App\Http\Controllers\PetroleumDerivatesController::class,'electricalVsCombustible']);
Route::get('/petroleum/petrolderivates/{month}',[App\Http\Controllers\PetroleumDerivatesController::class,'petrolDerivates']);
Route::get('/petroleum/oildata/{month}',[App\Http\Controllers\PetroleumDerivatesController::class,'oilData']);
Route::get('/petroleum/lessRefrigerant/{month}',[App\Http\Controllers\PetroleumDerivatesController::class,'lessRefrigerant']);
Route::get('/petroleum/lessvsmostmonth/{month}',[App\Http\Controllers\PetroleumDerivatesController::class,'moreVsLessCombustible']);


Route::apiResource('/electrical', ElectricalEnergyController::class);
Route::post('/electrical/storeElectricity',[App\Http\Controllers\ElectricalEnergyController::class,'store']);
Route::get('/travel/monthenergy/{month}',[App\Http\Controllers\ElectricalEnergyController::class,'monthEnergy']);

Route::apiResource('/travel', TravelsController::class);
Route::post('/travel/other',[App\Http\Controllers\TravelsController::class,'store']);
Route::post('/travel/sales',[App\Http\Controllers\TravelsController::class,'storeSale']);
Route::post('/travel/admin',[App\Http\Controllers\TravelsController::class,'storeAdmin']);
Route::get('/travel/byteams/{month}',[App\Http\Controllers\TravelsController::class,'salesVsAdmin']);


