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
    <h2>Gestion de Preguntas</h2>
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
            <th>Id</th>
            <th>Pregunta</th>
            <th>Mujer</th>
            <th width="250px">Operaciones</th>
        </tr>
        @foreach( $preguntas as $pregunta )
            <tr>
                <td>{{$pregunta->id}}</td>
                <td>{{$pregunta->pregunta}}</td>
                <td>{{$pregunta->mujeres->nombre}} {{$pregunta->mujeres->apellidos}}</td>
                <td>
                
                    <form action="{{ route('preguntas.destroy', $pregunta->id) }}" method="post">
                        
                        @method('DELETE')
                        @csrf
                        <a href="{{ route('preguntas.edit', $pregunta->id) }}" class="btn btn-primary" title="show"><span class="icon-edit"></span></a>
                        <button type="submit" class="btn btn-danger"><span class="icon-trash"></span></button>
                        
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="row">
        <div class="col text-center">
            <a class="btn btn-success  my-5" href="{{ route('preguntas.create') }}">Añadir Pregunta</a>
        </div>
    </div>
    <div class="row">
        <div class="col container">
            <div class="m-auto  w-auto text-center">
                @if($preguntas->count())
                    {{ $preguntas->links('pagination::bootstrap-4') }}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection