<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use App\Models\Mujer;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;

class EspecialidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $especialidades = Especialidad::latest()->paginate(7);
        return view('admin.especialidades.index')->with('especialidades',$especialidades)
             ->with('success', (request()->input('page', 1) - 1) * 5); 
               
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.especialidades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'color' => 'required',
        ]);

        Especialidad::create($request->all());

        return redirect()->route('especialidades.index')
            ->with('success','Especialidad insertada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function show(Especialidad $especialidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function edit($especialidad_id)
    {
        $especialidad = Especialidad::all()->find($especialidad_id);
        return view('admin.especialidades.edit', compact('especialidad'));
           
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $especialidad_id)
    {
        $request->validate([
           
        ]);
    
        $especialidad = Especialidad::find($especialidad_id);
        $especialidad->nombre = $request->input('nombre');
        $especialidad->color = $request->input('color');
        $especialidad->save();
    
        return redirect()->route('especialidades.index')
            ->with('success','Especialidad  se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Especialidad::all()->find($id)->delete();
        return redirect()->route('especialidades.index')
            ->with('success','Especialidad  eliminada correctamente');
    }
}
