@extends("layouts.page")

@section("head-extras")
<link rel="stylesheet" href="{{ URL::asset('css/game-page.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/juegoPuzzle.css') }}">

@endsection

@section("content")
<div id='content'></div>

<!-- div cuestionario -->
<div id="cuestionario" class="text-center p-5 text-dark" style="display: none; position: fixed; height:500px">
    <h2>Responde la pregunta para seguir avanzando.</h2><hr>
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

<script>
    var mujer = JSON.parse(localStorage.getItem("mujeres"));
    var cambioImagen;
    cambioImagen = setInterval('cambiarFoto()', 100);

    function cambiarFoto() {
        var imagenUrl = "/assets/Fotos_mujeres/" + mujer[0].foto;
        document.getElementsByClassName('pieza')[0].style.backgroundImage = "url(" + imagenUrl + ")";
        document.getElementsByClassName('pieza')[1].style.backgroundImage = "url(" + imagenUrl + ")";
        document.getElementsByClassName('pieza')[2].style.backgroundImage = "url(" + imagenUrl + ")";
        document.getElementsByClassName('pieza')[3].style.backgroundImage = "url(" + imagenUrl + ")";
        document.getElementsByClassName('pieza')[4].style.backgroundImage = "url(" + imagenUrl + ")";
        document.getElementsByClassName('pieza')[5].style.backgroundImage = "url(" + imagenUrl + ")";
        document.getElementsByClassName('pieza')[6].style.backgroundImage = "url(" + imagenUrl + ")";
        document.getElementsByClassName('pieza')[7].style.backgroundImage = "url(" + imagenUrl + ")";
        document.getElementsByClassName('pieza')[8].style.backgroundImage = "url(" + imagenUrl + ")";
        clearInterval(cambioImagen);
    }
</script>
<script src="{{ URL::asset('js/jsPuzzle.js' )}}"></script>
@endsection