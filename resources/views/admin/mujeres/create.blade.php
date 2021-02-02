@extends("layouts.page")

@section("head-extras")
    <link rel="stylesheet" href="{{asset("css/admin.css")}}">
    <link rel="stylesheet" href="{{asset("css/matching.css")}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
<div class="">
    <h1 class="text-center">Nueva Mujer</h1>
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
    <form action="{{ route('mujeres.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <p class="text-light">Nombre: *</p>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="col-12">
                <p class="text-light">Apellidos: *</p>
                <input type="text" name="apellidos" class="form-control" required>
            </div>
            <div class="col-12">
                <p class="text-light">Nacimiento: *</p>
                <input type="text" name="nacimiento" class="form-control" required>
            </div>
            <div class="col-12">
                <p class="text-light">Fallecimiento: </p>
                <input type="text" name="fallecido" class="form-control">
            </div>
            <div class="col-12">
                <p class="text-light">Nacionalidad: *</p>
                <input type="text" name="nacionalidad" class="form-control" required>
            </div>
            <div class="col-12">
                <p class="text-light">Especialidad: *</p>
                <select name="especialidad" id="" class="form-control" required>
                <option value="" selected>Seleccione Especialidad</option>
                   @foreach($especialidades as $especialidad)
                   <option value="{{$especialidad->id}}">{{$especialidad->nombre}}</option>
                   @endforeach
                </select>

            </div>
            <div class="col-12">
                <p class="text-light">Foto:</p>
                <input type="file" name="foto" class="form-control" accept="image/*" >
            </div>
            <div class="col-12">
                <p class="text-light">Descripción:</p>
                <input type="text" name="descripcion" class="form-control">
            </div>
            <div class="col-xs-12 guardar">
                <button type="submit" class="btn btn-success">Añadir</button>
                <a class="btn btn-primary ml-2" href="{{ route('mujeres.index')}}">Volver</a>
            </div>
        </div>
    </form>
</div>
@endsection
