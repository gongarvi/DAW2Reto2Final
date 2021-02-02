<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use App\Models\Mujer;
use Illuminate\Http\Request;

class ControladorPreguntas extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $preguntas = Pregunta::with(["mujeres"=>function($query){
           $query->get();
       }])->paginate(10);
       return view('admin.preguntas.index', compact('preguntas'))
            ->with('i',(request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mujeres = Mujer::all();
        return view('admin.preguntas.create', compact('mujeres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = $request->all();
        Pregunta::create($datos);
        return redirect()->route('preguntas.index')
            ->with('success','La pregunta ha sido insertada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function show(Pregunta $pregunta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function edit($pregunta_id)
    {
       
        $pregunta = Pregunta::with("mujeres")->where("id",$pregunta_id)->get()->first();
        return view('admin.preguntas.edit', compact('pregunta'))->with(["pregunta" => $pregunta, "mujeres" => Mujer::all()]);
            
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pregunta_id)
    {
         $request->validate([

         ]);
         $pregunta = Pregunta::find($pregunta_id);
         $pregunta->pregunta = $request->input('pregunta');
         $pregunta->mujer = $request->input('mujer');
         $pregunta->save();
         return redirect()->route('preguntas.index')
            ->with('success','Pregunta  modificada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function destroy($pregunta_id)
    {
        Pregunta::all()->find($pregunta_id)->delete();
        return redirect()->route('preguntas.index')
            ->with('success','Pregunta eliminada correctamente');
    }
}
