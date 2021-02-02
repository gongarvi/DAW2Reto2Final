<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use App\Models\Mujer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MujeresController extends Controller
{

    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mujeres = Mujer::with("especialidades")->paginate(10);

        return view('admin.mujeres.index', compact('mujeres'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $especialidades = Especialidad::all();
        return view('admin.mujeres.create',compact("especialidades"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();

        if($request->hasFile('foto')){
            $archivo = $request->file('foto');
            $nombre = $archivo->getClientOriginalName();
            $archivo->move("assets/Fotos_mujeres",$nombre);
            $data["foto"]=$nombre;
        }else{
            $data["foto"]="";
        }

        Mujer::create($data);

        return redirect()->route('mujeres.index')
            ->with('success','La mujer ha sido insertada correctamente');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mujer  $mujer
     * @return \Illuminate\Http\Response
     */
    public function show(Mujer $mujer)
    {
        //Vacio, no lo necesitamos
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mujer  $mujer
     * @return \Illuminate\Http\Response
     */
    public function edit($mujer_id)
    {
        $mujer=Mujer::with("especialidades")->where("id",$mujer_id)->get()->first();
        return view('admin.mujeres.edit',compact("mujer"))->with(["mujer"=>$mujer,"especialidades"=>Especialidad::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mujer  $mujer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $mujer_id)
    {
        $request->validate([
            "nombre"=>"required",
            "apellidos"=>"required",
            "nacionalidad"=>"required",
            "especialidad"=>"required",
            "descripcion"=>"required"
        ]);
        $mujer=Mujer::all()->find($mujer_id);
        if($mujer!=null){
            $data=$request->all();
            if($request->hasFile('foto')){
                $archivo = $request->file('foto');
                $nombre = $archivo->getClientOriginalName();
                $archivo->move("assets/Fotos_mujeres",$nombre);
                $data["foto"]=$nombre;
            }else{
                unset($mujer["foto"]);
            }
            $mujer->update($request->all());
        }
        return redirect()->route("mujeres.index")->with(["success"=>"Se ha actualizado la infomacion de".$mujer->nombre." ".$mujer->apellidos]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mujer  $mujer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($mujer_id)
    {

        Mujer::all()->find($mujer_id)->delete();
        return redirect()->route('mujeres.index')
            ->with('success','Mujer eliminada correctamente');
    }
}
