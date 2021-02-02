@extends("layouts.page")

@section("head-extras")

    <link rel="stylesheet" href="{{asset("css/matching.css")}}">
    <link rel="stylesheet" href="{{asset("css/admin.css")}}">
    <link rel="stylesheet" href="{{asset("css/panelControl.css")}}">
    <link rel="stylesheet" href="{{asset("css/iconos/style.css")}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@endsection

@section('content')

<div class="container container-fluid">
    <div class="row panel">
    <div class="col-12 col-lg-8 p-0 m-lg-auto">
        <ul class="list-group-flush p-0 my-auto">  
        <h1>Panel de adminstracion</h1>
            <li class="list-group-item border-0 bg-transparent"><a class="btn btn-outline-light w-100 menu" href="{{ route('usuarios.index') }}">Usuarios</a></li> 
            <li class="list-group-item border-0 bg-transparent"><a class="btn btn-outline-light w-100 menu" href="{{ route('mujeres.index') }}">Mujeres</a></li>
            <li class="list-group-item border-0 bg-transparent"><a class="btn btn-outline-light w-100 menu" href="{{route('especialidades.index')}}">Especialidades</a></li>
            <li class="list-group-item border-0 bg-transparent"><a class="btn btn-outline-light w-100 menu" href="{{ route('preguntas.index') }}">Preguntas</a></li>
            <li class="list-group-item border-0 bg-transparent"><a class="btn btn-outline-light w-100 menu" href="{{ route('respuestas.index') }}">Respuestas</a></li>
        </ul>
    </div>
    </div>
</div>

<script src="{{asset('js/app.js')}}">
    </script>
@endsection
