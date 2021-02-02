<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use App\Models\Respuesta;
use Illuminate\Http\Request;

class PreguntasAPIService extends Controller
{
    public function index(){
            $result = response("Ruta no valida, debe enviar el id de una mujer",501);
    }
    public function store(){}
    public function show($mujer){
        $result=[];

        if(is_numeric($mujer)){
            $pregunta=Pregunta::getPreguntaAleatoriaMujer($mujer);
            if($pregunta!=null){
                $respuestas=Respuesta::all()->where("pregunta",$pregunta->id);
                $respuestasResult=[];
                foreach ($respuestas as $respuesta){
                    $respuestasResult[]=$respuesta->toJsonArray();
                }
                $result[]=
                    [
                        "pregunta"=>$pregunta["pregunta"],
                        "respuestas"=>$respuestasResult
                    ];
            }
        }
        if($result!=[]&&count($result)==1){
            $result = response()->json($result[0]);
        }
        elseif($result!=[]&&count($result)>=1){
            $result = response()->json($result);
        }
        else{
            $result = response("No se han podido devolver datos o no existen",404);
        }
        return $result;
    }
    public function destroy(){}

}
