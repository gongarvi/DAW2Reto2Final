<?php

namespace App\Http\Controllers;
use App\Models\Mujer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Fotosperfil;

class MujeresAPIService extends Controller
{
    // la funcion para join de las tablas "Mujeres" y "Especialidades"
    public function index(){
        try{
            $array=Mujer::with("especialidades")->get();
            $result=[];
            foreach ($array as $item) {
                $especialidad = array(
                    "nombre" => $item->especialidades->nombre,
                    "color" => $item->especialidades->color
                );
                $mujer = array(
                    "id"=>$item->id,
                    "nombre" => $item->nombre,
                    "apellidos" => $item->apellidos,
                    "nacionalidad" => $item->nacionalidad,
                    "nacimiento" => $item->nacimiento,
                    "fallecido" => $item->fallecido,
                    "especialidad" => $especialidad,
                    "foto" => $item->foto,
                    "descripcion" => $item->descripcion
                );
                $result[] = $mujer;
            }
            return response()->json($result);
        }
        catch(\Exception $e){
            return response("No hay suficientes mujeres para realizar la peticion o hubbo un error en el servidor",500);
        }
    }
    //Funcion que devuelve un cantidad especifica de muejres de X especializacion
    public function show($cantidad, $especializacion){
        $result = [];
        if ($cantidad != null && $cantidad != 0 && $especializacion != null) {
            if ($especializacion != 0) {
                $array = Mujer::getMujeresPorEspecializacion($especializacion);
            } else {
                $array = Mujer::getMujeresAleatorias();
            }
            if(count($array)>$cantidad){
                $array = $array->random($cantidad);
            }
            foreach ($array as $item) {
                $especialidad = array(
                    "nombre" => $item->especialidades->nombre,
                    "color" => $item->especialidades->color
                );
                $mujer = array(
                    "id"=>$item->id,
                    "nombre" => $item->nombre,
                    "apellidos" => $item->apellidos,
                    "nacionalidad" => $item->nacionalidad,
                    "nacimiento" => $item->nacimiento,
                    "fallecido" => $item->fallecido,
                    "especialidad" => $especialidad,
                    "foto" => $item->foto,
                    "descripcion" => $item->descripcion
                );
                $result[] = $mujer;
            }
            if ($result != [] || count($result) == 0) {
                $result = response()->json($result);
            } else {
                $result = response("No se han podido devolver datos o no existen", 404);
            }
            return $result;
        }
    }
    public function fotoPerfilMujer($array){
        $arraycompleto =  explode(",", $array);
        $usuario = Auth::user();
        $idUsuario=$usuario->id;
        for($i=0;$i<count($arraycompleto);$i++){
            Fotosperfil::where('mujer',"=" ,$arraycompleto[$i])
            ->where('usuario',"=" ,$idUsuario)
            ->delete();
            $fotoPerfil = new Fotosperfil();
            $fotoPerfil->usuario = $idUsuario;
            $fotoPerfil->mujer = $arraycompleto[$i];
            $fotoPerfil->save();
        }
        return redirect('/juegos');
    }

}
