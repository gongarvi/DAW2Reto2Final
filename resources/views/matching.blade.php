@extends("layouts.page")

@section("head-extras")

    <link rel="stylesheet" href="{{asset("css/mujeres.css")}}">
    <link rel="stylesheet" href="{{asset("css/matching.css")}}">
    <link rel="stylesheet" href="{{asset("css/iconos/style.css")}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    @endsection


@section('content')
<h2>Juego del Matching</h2>
    <div class="puntos">
        <img src="..\image/logo.png" height="30">
        <img src="..\image/logo.png" height="30">
        <img src="..\image/logo.png" height="30">
        <img src="..\image/logo.png" height="30">
        <img src="..\image/logo.png" height="30">
        <img src="..\image/logo.png" height="30">

    </div>
    <div class="contenedor">
        <div class="nombres"></div>
        <div class="fotos"></div>
    </div>
    <div id="contenedor-mensaje-victoria" class="ocultar-mensaje">
        <div id="mensaje-victoria">
            <h3>Felicidades!!!</h3>
            <h4>Has completado el nivel</h4>
            <img src="..\assets\Fotos_mujeres\felicitar.gif">
            <button class="btn btn-success" id="guardar">Seguir Jugando</button>
        </div>
    </div>
    <div id="contenedor-mensaje-derrota" class="ocultar-mensaje">
        <div id="mensaje-derrota">
            <h3>Lo sentimos!!!</h3>
            <h4>No has podido completar el nivel, vuelve a intentarlo.</h4>
            <span class="icon-emoji-sad"></span>
            <a href=""><button class="btn btn-primary">Otra partida</button></a>
        </div>
    </div>
    <div class="container inst">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 instrucciones ">
                <h4>OBJETIVO</h4>
                <p>Relacionar cada nombre con su foto correspondiente</p>
                <h4>Instrucciones del juego</h4>
                <ul>
                    <li>1._Clicar en cualquier carta con interrogante para descubrir el nombre</li>
                    <li>2._Clicar en alguna carta con foto que creas corespondiente con el nombre descubierto</li>
                    <li>En caso de acertar, ambas cartas se marcarán en verde</li>
                    <li>Si fallamos, el nombre se oculta de nuevo y se nos resta una vida</li>
                </ul>
                <ul class="pd">PD:
                    <li>No clicar antes la carta que contiene la foto</li>
                </ul>
            </div>
        </div>
    </div>
<script src="{{ asset('js/match.js') }}">

</script>
<!-- <script src="resources\js\match.js"></script> -->
@endsection

