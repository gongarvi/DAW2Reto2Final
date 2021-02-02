@extends("layouts.page")

@section("head-extras")
    <link rel="stylesheet" href="{{asset("css/formularios.css")}}">
@endsection

@section("content")
@if($errors->any())
    @foreach($errors->all as $error)
        <p>{{$error}}</p>
    @endforeach
@endif
<div id="formulario" class="container">
    <div class="row w-100 justify-content-center">
		<div class="col-md-8">
            @if($message =Session::get('success'))
                <div class="alert alter-success">
                    <p>{{$message}}</p>
                </div>
            @endif

            <form action="/fotosperfil/{{$usuario->id}}" method="POST">
                @csrf
                @method('POST')
                <div class="form-group text-center">
                    <img src="{{ (trim($usuario->foto)!=='')?asset('assets/Fotos_mujeres/'.$usuario->foto):asset('image/placeholder-usuario.png')}}" alt="" title="" class="rounded-circle" style="height: 200px;"/><br>
                    <p class="list-group-item border-0 bg-transparent" type="submit"><button class="btn btn-outline-light w-40">> Cambiar foto</button></p>

                </div>
            </form>

            <form @submit="actualizarDatosPerfil($event)" action="/actualizarPerfil/{{$usuario->id}}" method="POST">
                @csrf
                <input type="hidden" value="datos" name="funcion">
                <h2>Cambiar nombre:</h2>
				<div class="form-group">
                    <label for="name" class="text-light">Nombre: </label>
                    <input  name="name" value="{{$usuario->name}}" class="form-control"  type="text">
                </div>

				<div class="form-group">
                    <label for="email" class="text-light">Correo: </label>
                    <input readonly name="email" placeholder="{{$usuario->email}}" class="form-control"  type="email">
				</div>

                <div class="form-group">
                    <label for="password" class="text-warning">Escribe tu contraseña para confirmar</label>
                    <input  name="password" placeholder="Contraseña" class="form-control"  type="password">
				</div>
                <input type="reset" class="btn btn-danger mb-2">
                <input type="submit" value="Actualizar Usuario" class="btn btn-success mb-2">
            </form>

            <form @submit="actualizarPassword($event)" action="/actualizarPerfil/{{$usuario->id}}" method="post">
                @method('POST')
                @csrf
                <h2 class="mt-5">Cambiar contraseña:</h2>
				<input type="hidden" value="contrasena" name="funcion">

				<div class="form-group">
                    <input  name="password_actual" placeholder="Contraseña actual" class="form-control"  type="password">
                </div>

				<div class="form-group">
                    <input name="password_nueva" placeholder="Contraseña nueva" class="form-control"  type="password">
				</div>

                <div class="form-group">
                    <input  name="password_confirmar" placeholder="Confirmar contraseña nueva" class="form-control"  type="password">
				</div>
                <input type="reset" class="btn btn-danger mb-2">
                <input type="submit" value="Actualizar contraseña" class="btn btn-success mb-2">
			</form>

            <button class="btn btn-danger mt-5" data-toggle="modal" data-target="#myModal">Eliminar mi cuenta</button>
            <form action="/eliminarPerfil/{{$usuario->id}}" method="post">
                @method('POST')
                @csrf

                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content text-dark">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body text-center">
                                <h4>¿Esta seguro que desea eliminar su usuario?</h4>
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

		</div>
	</div>
</div>
<script src="{{asset('js/app.js')}}"></script>

<script src="{{asset('js/formulario.js')}}"></script>
@endsection
