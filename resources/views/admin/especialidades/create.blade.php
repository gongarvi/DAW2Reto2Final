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
    <h2>Agregar Especialidad</h2>
</div>

<div class="datos">

    @if ($errors->any())
        <div class="alert alert-danger w-100">
            <strong>Atencion</strong>Has dejado algun campo vacio<br><br>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('especialidades.store')}}" method="post">
        @csrf
        
        <div  class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
               <label for="">Nombre:</label>
               <input type="text" name="nombre" class="form-control">
            </div>
        </div>
        <div  class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
               <label for="">Color:</label>
               <input type="color" name="color" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 guardar">
                <button type="submit" class="btn btn-success">AGREGAR</button>
                <a class="btn btn-primary ml-2" href="{{ route('especialidades.index')}}">Volver</a>
        </div>
    </form>
    
</div>

@endsection