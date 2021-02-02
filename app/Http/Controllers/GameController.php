<?php

namespace App\Http\Controllers;
use App\Models\Especialidad;
use App\Models\Pregunta;
use App\Models\Respuesta;
use App\View\Components\GameCard;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;

class GameController extends Controller{
    public array $juegos;
    public array $especialidades;

    public function __construct(){
        //TODO Eliminar cuando se recoja de la BBDD
        $this->middleware("auth.basic");

        $this->juegos = array(
            array(
                "id"=>"1",
                "nombre"=>"matching",
                "descripcion"=>"En este juego deberas unir las mujeres con su nombre o su profesion",
                "imagen"=>"resources/assets/Fotos_Juegos/matching.png",
                "descripcion"=>"En este juego deberas unir las mujeres con su profesión o su logro",
                "imagen"=>"assets/Fotos_Juegos/matching.png"
            ),
            array(
                "id"=>"2",
                "nombre"=>"puzzle",
                "descripcion"=>"En este juego deberas unir las distintas piezas que juntas mostraran a una mujer",
                "imagen"=>"assets/Fotos_Juegos/puzzle.png"
            ),
            array(
                "id"=>"3",
                "nombre"=>"buscaminas",
                "descripcion"=>"En este juego deberas evitar las bombas para descubrir el rosotro de una mujer",
                "imagen"=>"assets/Fotos_Juegos/buscaminas.png"
            ),
            array(
                "id"=>"4",
                "nombre"=>"millonario",

                "descripcion"=>"En este juego deberas responder las preguntas de las distintas mujeres.",
                "imagen"=>"assets/Fotos_Juegos/quiz.png"
            ),
            array(
                "id"=>"Final",
                "nombre"=>"tresenraya",
                "descripcion"=>"En este juego deberas ganar una partida de 3 en raya contra una inteligente maquina",
                "imagen"=>"assets/Fotos_Juegos/images.png"
            ),
            array(
                "id"=>"Extra",
                "nombre"=>"tresenrayasdiablo",
                "descripcion"=>"En este juego deberas ganar una partida de 3 en raya contra una inteligente maquina",
                "imagen"=>"assets/Fotos_Juegos/images.png"
            ),
        );

    }


    public function cargarMujeresRandom($especialidad){
        if ($especialidad == 10){
            $tablaMujer = DB::table('mujeres')->get();
        }else{
            $tablaMujer = DB::table('mujeres')->limit(3)->select('*')->where('especialidad', '=', $especialidad)->inRandomOrder()->get();
        }

        return $tablaMujer;
    }
    function cargarMujeres(){
        $tablaMujer = DB::table('mujeres')->limit(6)->get();
        return $tablaMujer;
    }
    public function match(){
        return view("matching", ["mujeres"=>self::cargarMujeres()]);
    }
    public function show(){
        Blade::component('game-card', GameCard::class);
        return view("game", ["juegos"=>$this->juegos,"especialidades"=>$this->cargarEspecialidades()]);
    }

    public function ruleta($Especialidad,$juego){
        return view("ruleta", ["senoras"=>self::cargarMujeresRandom($Especialidad),"juego"=>$juego,"especialidad"=>$Especialidad]);
    }
    public function puzzle(){
        return view("puzzle");
    }

    private function cargarEspecialidades(){
        $tabla = Especialidad::all();
        return $tabla;
    }
}
