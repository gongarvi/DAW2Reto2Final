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
    <h2>Editar Respuestas</h2>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="volver">
            
        </div>
    </div>
</div>

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

@if($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{$message}}</p>
    </div>
@endif

<div class="datos container">
    <form action="{{route('respuestas.update',$pregunta)}}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="">Pregunta</label>
                   <select name="" id="" class="form-control">
                        <option value="{{$pregunta->id}}" selected>{{$pregunta->pregunta}}</option>
                   </select>
                </div>
            </div>
            <div class="col-sm-12">
            
            @foreach($pregunta->respuestas as $respuesta)
                <div class="form-group">

                    @if($respuesta->correcta)
                        <label for="">Respuesta correcta</label>
                    @else
                        <label for="">Respuesta incorrecta</label>
                    @endif
                        <input type="text" name="respuestas[{{$respuesta->id}}]" class="form-control" value="{{$respuesta->respuesta}}" required>
                    </div>                    
            @endforeach
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 guardar">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a class="btn btn-primary ml-2" href="{{ route('respuestas.index')}}">Volver</a>
            </div>
          
        </div>
    </form>
</div>
@endsection