@extends("layouts.page")

@section("head-extras")

    <link rel="stylesheet" href="{{asset("css/mujeres.css")}}">
    <link rel="stylesheet" href="{{asset("css/matching.css")}}">
    <link rel="stylesheet" href="{{asset("css/admin.css")}}">
    <link rel="stylesheet" href="{{asset("css/iconos/style.css")}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

@endsection

@section('content')

<div class="">
    <h2>Editar pregunta</h2>
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

        <form action="{{route("preguntas.update",$pregunta)}}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <p>Pregunta:</p>
                    <input type="text" name="pregunta" value="{{$pregunta->pregunta}}" class="form-control" required>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <p>Mujer:</p>
                    <select name="mujer" class="form-control" required>
                    @if($pregunta->mujeres==null)
                        <option disabled value="">Seleccione una Mujer</option>
                    @endif
                        @foreach($mujeres as $mujer)
                            @if($pregunta->mujeres!=null && $mujer->id===$pregunta->mujeres->id)
                            <option selected value="{{$mujer->id}}">{{$mujer->nombre}} {{$mujer->apellidos}}</option>
                            @else
                            <option  value="{{$mujer->id}}">{{$mujer->nombre}} {{$mujer->apellidos}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 guardar">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a class="btn btn-primary ml-2" href="{{ route('preguntas.index')}}">Volver</a>
            </div>
        </div>
    </form>
</div>
@endsection
