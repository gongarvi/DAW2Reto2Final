@extends("layouts.page")

@section("head-extras")

    <link rel="stylesheet" href="{{asset("css/mujeres.css")}}">
    <link rel="stylesheet" href="{{asset("css/admin.css")}}">
    <link rel="stylesheet" href="{{asset("css/matching.css")}}">
    <link rel="stylesheet" href="{{asset("css/iconos/style.css")}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

@endsection

@section('content')

<div class="">
    <h2>Insertar Respuesta</h2>
</div>

<div class="datos">
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Atencion</strong>Has dejado algun campo vacio<br><br>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('respuestas.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="">Escoja la pregunta:</label>
                    <select name="pregunta" class="form-control">
                        @foreach($preguntas as $pregunta)
                            <option value="{{$pregunta->id}}">{{$pregunta->pregunta}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="">Respuesta correcta</label>
                    <input type="text" name="correcta" class="form-control" required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="">Respuesta Falsa 1</label>
                    <input type="text" name="falsa1" class="form-control" required>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="">Respuesta Falsa 2</label>
                    <input type="text" name="falsa2" class="form-control" required>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="">Respuesta Falsa 3</label>
                    <input type="text" name="falsa3" class="form-control"required>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Añadir</button>
                    <a class="btn btn-primary" href="{{ route('respuestas.index')}}">Volver</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
