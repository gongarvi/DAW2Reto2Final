<?php

namespace App\Http\Controllers;

use App\Models\Fotosperfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FotosperfilController extends Controller
{
    public function __construct()
    {

    }

    public function show($id){
        $fotosperfil = Fotosperfil::all()
        ->find($id)
        ->with("Mujer")
        ->get();
        return view('perfil.edit',['usuario'=>$fotosperfil]);
    }

    public function desbloquearMujer(Request $request,$id_mujer){
        var_dump($request->header());
        var_dump($id_mujer);
    }
}
