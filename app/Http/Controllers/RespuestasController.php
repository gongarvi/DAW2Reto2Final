<?php

namespace App\Http\Controllers;

use App\Models\Respuesta;
use App\Models\Pregunta;
use Illuminate\Http\Request;

class RespuestasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $respuestas = Respuesta::with(["preguntas"=>function($query){
            $query->get();
        }])->paginate(15);
        return view('admin.respuestas.index', compact('respuestas'))
            ->with('i',(request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $preguntas = Pregunta::all();
        return view('admin.respuestas.create', compact('preguntas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        $respuesta1 = new Respuesta();
        $respuesta1->correcta = true;
        $respuesta1->respuesta = $request->input("correcta");
        $respuesta1->pregunta = $request->input("pregunta");
        $respuesta1->save();

        $respuesta2 = new Respuesta();
        $respuesta2->correcta = false;
        $respuesta2->respuesta = $request->input("falsa1");
        $respuesta2->pregunta = $request->input("pregunta");
        $respuesta2->save();

        $respuesta3 = new Respuesta();
        $respuesta3->correcta = false;
        $respuesta3->respuesta = $request->input("falsa2");
        $respuesta3->pregunta = $request->input("pregunta");
        $respuesta3->save();

        $respuesta4 = new Respuesta();
        $respuesta4->correcta = false;
        $respuesta4->respuesta = $request->input("falsa3");
        $respuesta4->pregunta = $request->input("pregunta");
        $respuesta4->save();

        return redirect()->route('respuestas.index')
            ->with('success', 'Respuestas insertadas correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Respuesta  $respuesta
     * @return \Illuminate\Http\Response
     */
    public function show(Respuesta $respuesta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Respuesta  $respuesta
     * @return \Illuminate\Http\Response
     */
    public function edit($pregunta_id)
    {
        $pregunta = Pregunta::with("respuestas")->where("id",$pregunta_id)->get()->first();
        return view('admin.respuestas.edit', compact('pregunta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Respuesta  $respuesta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pregunta_id)
    {
        $respuestas=Respuesta::all();
        $respuestas_form=$request->input("respuestas");
        foreach($respuestas_form as $index=>$respuesta_form){
            $respuesta_encontrada=$respuestas->find($index);
            $respuesta_encontrada->respuesta=$respuesta_form;
            $respuesta_encontrada->save();
        }
        $pregunta = Pregunta::with("respuestas")->where("id",$pregunta_id)->get()->first();
        return redirect()->route('respuestas.edit', $pregunta)
            ->with('success','Respuestas modificadas correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Respuesta  $respuesta
     * @return \Illuminate\Http\Response
     */
    public function destroy($respuesta_id)
    {
        //Aqui eliminamos la pregunta cuyo id es igual al id de la respuesta
        $respuesta=Respuesta::all()->find($respuesta_id);
        Pregunta::all()->find($respuesta->pregunta)->delete();

        return redirect()->route('respuestas.index')
            ->with('success','Respuestas eliminadas correctamente');

    }
}
