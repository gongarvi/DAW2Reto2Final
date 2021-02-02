@extends("layouts.page")

@section("head-extras")
<link rel="stylesheet" href="{{ URL::asset('css/game-page.css') }}">

@endsection

@section("content")
<div id="app">
    <!--Aqui vendran las categorias que se podran jugar-->
    <div id="game-cards-controller" class="container mt-5 pr-5 pt-5 pb-2" style="background-color: rgba(0,0,0,0.555);">
        <div class="pl-5 pb-4">
            <h4>Seleccione una tematica para jugar, en caso de seleccionar Todas jugara con todas las categorias.</h4>
                <select class="form-control" id="selectEspecialidad" name="combo">
                    <option value="0">Todos</option>
                    @foreach($especialidades as $especialidad)
                    <option value="{{$especialidad->id}}">{{$especialidad->nombre}}</option>
                    @endforeach
                </select>
        </div>
        
        <ul class="row">
            @foreach($juegos as $jueg=>$juego)
            <li class="list-group-item border-0 col-xs-12 col-sm-4" style="background-color: rgba(0, 0, 0, 0);">
                <x-gamecard :juego="$juego"></x-gamecard>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<script src="{{"js/game-page.js"}}" defer></script>
@endsection
