<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PreguntasAPIService;
use \App\Http\Controllers\EspecializacionesAPIService;
use \App\Http\Controllers\MujeresAPIService;
use \App\Http\Controllers\FotosperfilController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("preguntas",PreguntasAPIService::class);
Route::apiResource("especialidades",EspecializacionesAPIService::class);
Route::get("mujeres",[MujeresAPIService::class,"index"]);
Route::post("mujeres/desbloquear/{mujer}",[FotosperfilController::class,"desbloquearMujer"]);
Route::get("mujeres/{cantidad}/{especializacion}",[MujeresAPIService::class,"show"]);
//Route::apiResource("mujeres",MujeresAPIService::class);



