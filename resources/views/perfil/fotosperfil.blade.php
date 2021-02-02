@extends("layouts.page")

@section("head-extras")
<link rel="stylesheet" href="{{asset("css/formularios.css")}}">
@endsection

@section("content")
<div class="container">
    <div class="row w-100 justify-content-center">
        <div class="col-md-8">
            <h4 id="texto" class="border-bottom border-light p-2 text-center">Elige la foto que quieras poner como tu perfil. Puedes ganar mas fotos jugando e los juegos.</h4>
            @foreach($mujeres as $mujer)
            <a href="/actualizarfoto/{{$idperfil}}/{{$mujer->foto}}" id="fotos">
                <img src="/assets/Fotos_mujeres/{{$mujer->foto}}" alt="La foto" class="rounded" id="fotosperfil">
            </a>
            @endforeach
        </div>
    </div>
</div>

@endsection