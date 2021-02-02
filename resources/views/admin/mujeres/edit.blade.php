@extends("layouts.page")

@section("head-extras")

    <link rel="stylesheet" href="{{asset("css/admin.css")}}">
    <link rel="stylesheet" href="{{asset("css/iconos/style.css")}}">
    <link rel="stylesheet" href="{{asset("css/matching.css")}}">

@endsection

@section('content')

<div class="">
    <h1>Editar mujer</h1>
</div>

<div id="formulario" class="datos">

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
        <form action="{{route("mujeres.update",$mujer)}}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <p>Nombre:</p>
                    <input type="text" name="nombre" value="{{$mujer->nombre}}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <p>Apellidos:</p>
                    <input type="text" name="apellidos" value="{{$mujer->apellidos}}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <p>Nacimiento:</p>
                    <input type="text" name="nacimiento" value="{{$mujer->nacimiento}}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <p>Fallecimiento:</p>
                    <input type="text" name="fallecido" value="{{$mujer->fallecido}}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <p>Nacionalidad:</p>
                    <input type="text" name="nacionalidad" value="{{$mujer->nacionalidad}}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <p>Especialidad:</p>
                    <select name="especialidad" class="form-control" required>
                    @if($mujer->especialdies==null)
                    <option disabled value="">Selecciona una especialidad</option>
                    @endif
                        @foreach($especialidades as $especialidad)

                            @if($mujer->especialidades!=null && $especialidad->id===$mujer->especialidades->id)
                                <option selected value="{{$especialidad->id}}">{{$especialidad->nombre}}</option>
                            @else
                            <option value="{{$especialidad->id}}">{{$especialidad->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <p>Foto:</p>
                    <input id="foto" type="file" name="foto" value="{{$mujer->foto}}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <p>Descripción:</p>
                    <input type="text" name="descripcion" value="{{$mujer->descripcion}}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 guardar">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a class="btn btn-primary ml-2" href="{{ route('mujeres.index')}}">Volver</a>
            </div>
        </div>
    </form>
</div>
<script src="{{asset("js/formulario.js")}}"></script>
@endsection
