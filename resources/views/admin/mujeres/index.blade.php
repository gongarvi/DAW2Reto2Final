@extends("layouts.page")

@section("head-extras")

    <link rel="stylesheet" href="{{asset("css/mujeres.css")}}">
    <link rel="stylesheet" href="{{asset("css/matching.css")}}">
    <link rel="stylesheet" href="{{asset("css/admin.css")}}">
    <link rel="stylesheet" href="{{asset("css/iconos/style.css")}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@endsection

@section('content')
<div class="">
    <h2>Gestion de Mujeres</h2>
</div>

<div class="datos container">
@if($message = Session::get('success'))
    <div class="alert alert-success w-100">
        <p>{{$message}}</p>
    </div>
@endif
<a href="{{ route ('panel')}}" style="display:flex; justify-content:center; text-decoration:none; "><button class="btn btn-info">Volver al panel</button></a>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Nacimiento</th>
            <th>Fecha Muerte</th>
            <th>Nacionalidad</th>
            <th>Especialidad</th>
            <th width="250px">Operaciones</th>
        </tr>
        @foreach( $mujeres as $mujer )
            <tr>
                <td>{{$mujer->nombre}}</td>
                <td>{{$mujer->apellidos}}</td>
                <td>{{$mujer->nacimiento}}</td>
                <td>{{$mujer->fallecido}}</td>
                <td>{{$mujer->nacionalidad}}</td>
                <td>{{($mujer->especialidades!=null)?$mujer->especialidades->nombre:""}}</td>
                <td>
                    <form action="{{route("mujeres.destroy",$mujer)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <a href="{{route("mujeres.edit",$mujer)}}" class="btn btn-primary" title="show"><span class="icon-edit"></span></a>
                        <button type="submit" title="delete" class="btn btn-danger"><span class="icon-trash"></span></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="row">
        <div class="col text-center">
            <a class="btn btn-success  my-5" href="{{route("mujeres.create")}}">Añadir Mujer</a>
        </div>
    </div>
    <div class="row">
        <div class="col container">
            <div class="m-auto  w-auto text-center">
                @if($mujeres->count())
                    {{ $mujeres->links('pagination::bootstrap-4') }}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
