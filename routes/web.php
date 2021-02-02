<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\RespuestasController;
use App\Http\Controllers\ControladorUsuarios;
use App\Http\Controllers\MujeresAPIService;
use App\Http\Controllers\EspecialidadesController;
use App\Http\Controllers\ControladorPreguntas;
use App\Http\Controllers\MujeresController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\modoHistoriaController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('', function () {
    return view('welcome');
})->name("inicio");

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


//Abrir nuevo enlace a menu juegos y juegos
Route::get("/juegos/matching", [GameController::class,"match"])->name("matching");

Route::get("/juegos/buscaminas", function(){ return view("buscaminas");})->name("buscaminas");

Route::get("/juegos/millonario", function(){
    return view("millonario");
})->name("millonario");

Route::get('/juegos/ruleta/{id}/{juego}', [GameController::class,"ruleta"]);



Route::get("/juegos/tresenraya", function(){ 
    return view("tresenrayas");
})->name("tresenrayas");

Route::get("/juegos",[GameController::class,"show"])->name("juegos");

Route::get("/juegos/puzzle",[GameController::class,"puzzle"])->name("Puzzle");

Route::get("/juegos/tresenrayasdiablo", function(){
    return view("tresenrayasdiablo");
})->name("tresenrayasdiablo");

Route::get("/juegos",[GameController::class,"show"])->name("juegos");

Route::get("/juegos/Puzzle",[GameController::class,"puzzle"])->name("Puzzle");

Route::get("/mujeres",function(){
    return view("mujeres");
})->name("mujeres");

Route::get("/perfil",[GameController::class,"show"])->name("perfil");

Route::get("/logout",[GameController::class,"show"])->name("logout");


//Administracion
Route::group(["middleware"=>["auth.basic","auth.admin"]],function(){
    //Navegación panel de control
    Route::get('/panelControl', [HomeController::class, 'panelControl'])->name('panel');
    //Rutas para la administracion de las mujeres
    Route::resource("admin/mujeres",MujeresController::class,["except"=>["show"]]);
    //Rutas para la administracion de los usuarios
    Route::resource("admin/usuarios",ControladorUsuarios::class, ["except"=>["show"]]);
    //Rutas para la administracion de las especialidades
    Route::resource("admin/especialidades",EspecialidadesController::class, ["except"=>["show"]]);
    //Rutas para la administracion de las preguntas
    Route::resource("admin/preguntas",ControladorPreguntas::class, ["except"=>["show"]]);
    //Rutas para la administracion de las respuestas
    Route::resource("admin/respuestas",RespuestasController::class, ["except"=>["show"]]);
});
Route::post("/fotosperfil/{id}",[PerfilController::class,"fotosperfil"])->name("fotosperfil");
Route::get("/actualizarfoto/{id}/{nombrefoto}",[PerfilController::class,"actualizarfoto"])->name("actualizarfoto");
Route::get("/perfil/{id}",[PerfilController::class,"edit"])->name("perfil");
Route::post("/actualizarPerfil/{id}",[PerfilController::class,"update"])->name("actualizarPerfil");
Route::post("/eliminarPerfil/{id}",[PerfilController::class,"delete"])->name("eliminarPerfil");

Route::get("/guardarmujerperfil/{array}",[MujeresAPIService::class,"fotoPerfilMujer"])->name("guardarmujerperfil");