@extends("layouts.page")

@section("head-extras")
    <link rel="stylesheet" href="{{asset("css/formularios.css")}}">
@endsection

@section('content')
<div id="formulario" class="container">
    <div class="row justify-content-center">
		<div class="col-md-8">
            <form method="POST" action="{{ route('register') }}">
                @csrf
				<h2 class="md-5">Registrar</h2>
				<div class="form-group">
                    <label for="name">Nombre:</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="ej: Juanita">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

				<div class="form-group">
                    <label for="email">Correo electronico:</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="ej: juanita@email.com">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
				</div>

                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="ej: 123456Aa">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
				</div>

                <div class="form-group">
                    <label for="password-confirm">Confirmar contraseña:</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
				</div>

				<button type="reset" class="btn btn-danger">Limpiar</button>
                <button type="submit" class="btn btn-success">Registrar</button>

			</form>
		</div>
	</div>
</div>
<script src="{{asset('js/formulario.js')}}"></script>
@endsection
