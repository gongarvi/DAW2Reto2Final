<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller{
    public function fotosperfil($id){
        $mujeres = DB::table('fotosperfil')
        ->join('mujeres', 'fotosperfil.mujer','=', 'mujeres.id')
        ->select('fotosperfil.*', 'mujeres.foto')
        ->where('fotosperfil.usuario', '=', $id)
        ->get();
        return view('perfil.fotosperfil',['mujeres'=>$mujeres,'idperfil'=>$id]);
    }
    public function actualizarfoto($id, $nombrefoto){
        $perfil = User::where('id','=',$id)->first();
        $perfil->foto = $nombrefoto;
        $perfil->save();
        $perfil = User::where('id','=',$id)->first();
        return view("perfil.edit",['usuario'=>$perfil]); 
    }

    public function edit($id){
        $persona = User::all()->find($id);
        return view('perfil.edit',['usuario'=>$persona]);
    }

    public function delete($id)
    {
        $persona = User::find($id);
        $persona->delete();
        return redirect('');
    }

    public function update(Request $request, $id){ 
        $request->validate([
            'funcion' => ['required'],
        ]);
        $persona=User::all()->find($id);
        
        // para cambiar los datos del usuario
        if($request["funcion"]==="datos"){
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8'],
            ]);
            $data=$request->all();
            if(Hash::check($data["password"],$persona->password)){
                unset($data["password"]);
                unset($data["email"]);
                $persona->update($data);
                echo("Correcto hecho");
            }else{
                return view('perfil.edit',['usuario'=>$persona])->with("error","No se han modificado los datos");
                
            }
        }
        // para cambiar la contraseña
        elseif($request["funcion"]==="contrasena"){
            $request->validate([
                'password_actual' => ['required', 'string', 'min:8'],
                'password_nueva' => ['required', 'string', 'min:8'],
                'password_confirmar' => ['required', 'string', 'min:8']
            ]);
            
            if(Hash::check($request->input('password_actual'),$persona->password)){
                if($request->input('password_nueva')===$request->input('password_confirmar')){
                    $data["password"]=Hash::make($request->input('password_nueva'));
                    $persona->update($data);
                }else{
                    return view('perfil.edit',['perfil'=>$persona])->with("error","No se ha cambiado la contraseña");
                }
                $data["password"]=Hash::make($request->input('password_nueva'));
                $persona=User::all()->find($id);
                $persona->update($data);
            }
        }
        return response()->redirectTo(route("perfil",$persona->id));
        

    }
}
