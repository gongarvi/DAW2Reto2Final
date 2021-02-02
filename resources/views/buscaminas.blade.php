@extends("layouts.page")

@section("head-extras")
<link rel="stylesheet" href="{{ URL::asset('css/game-page.css') }}">
<link rel="stylesheet" href="{{asset("css/mujeres.css")}}">
<link rel="stylesheet" href="{{asset("css/matching.css")}}">
<link rel="stylesheet" href="{{asset("css/iconos/style.css")}}">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@endsection

@section("content")
<div id="app">
    <h1>DESAYUNOS FEMINISTAS </h1></BR>
    <h2>BUSCAMINAS</h2>
    <buscaminas />
</div>

<div id="cuestionario" class="text-center p-5 text-dark" style="display: none; position: fixed; height:500px">
    <h2>Responde la pregunta para seguir avanzando.</h2>
    <hr>
    <h4 id="pregunta"></h4>
    <div class="row">
        <div class="col-sm-10">
            <div class="form-group">
                <select class="selectpicker form-control" id="respuestas">
                    <option value="" class="respuesta">Selecciona una respuesta</option>
                </select>
            </div>
        </div>
    </div>
    <button class="btn btn-success" id="validar">validar</button>
</div>

<div id="contenedor-mensaje-victoria" class="ocultar-mensaje">
    <div id="mensaje-victoria">
        <h3>Felicidades!!!</h3>
        <h4>Has completado el nivel</h4>
        <button class="btn btn-success" id="guardar">Salir</button>
    </div>
</div>
<div id="contenedor-mensaje-derrota" class="ocultar-mensaje">
    <div id="mensaje-derrota">
        <h3>Has perdido!!!</h3>
        <h4>No has podido completar el nivel, vuelve a intentarlo</h4>
        <button class="btn btn-danger" id="otrapartida">Volver al menu de juegos</button>
    </div>
</div>
<script src="{{asset('js/buscaminas.js')}}"></script>
@endsection