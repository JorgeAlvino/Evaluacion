<?php

use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\TurnoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::resource('/Pelicula',PeliculaController::class);

Route::resource('/Turno',TurnoController::class);
Route::get('/Pelicula/Turno/{id}',[TurnoController::class,'peliculaturno']);




