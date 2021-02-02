@extends("layouts.page")

@section("head-extras")

    <link rel="stylesheet" href="{{asset("css/mujeres.css")}}">
    <link rel="stylesheet" href="{{asset("css/admin.css")}}">
    <link rel="stylesheet" href="{{asset("css/matching.css")}}">
    <link rel="stylesheet" href="{{asset("css/iconos/style.css")}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@endsection

@section('content')

<div class="">
    <h2>Gestion de Respuestas</h2>
</div>

<div class="datos container">
    @if($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}</p>
        </div>
    @endif
    <a href="{{ route ('panel')}}" style="display:flex; justify-content:center; text-decoration:none; "><button class="btn btn-info">Volver al panel</button></a>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Pregunta</th>
                <th>Posibles Respuestas</th>
                <th>Correcta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($respuestas as $respuesta)
            
            <tr>
                <td>{{$respuesta->id}}</td>
                <td width="auto">{{$respuesta->preguntas->pregunta}}</td>
                <td>{{$respuesta->respuesta}}</td>
                <td>{{($respuesta->correcta)?"Verdadera":"Falsa"}}</td>
                <td width="200px">
                    <form action="{{ route('respuestas.destroy', $respuesta->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('respuestas.edit', $respuesta->preguntas->id) }}" class="btn btn-primary" title="show"><span class="icon-edit"></span></a>
                        <button type="submit" title="delete" class="btn btn-danger"><span class="icon-trash"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col text-center">
            <a class="btn btn-success  my-5" href="{{ route('respuestas.create') }}">Añadir Respuesta</a>
        </div>
    </div>
    <div class="row">
        <div class="col container">
            <div class="m-auto  w-auto text-center">
                @if($respuestas->count())
                    {{ $respuestas->links('pagination::bootstrap-4') }}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection