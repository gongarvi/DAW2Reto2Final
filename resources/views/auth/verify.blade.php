@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verifica la contraseña</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Te llegara un correo para recuperar la contraseña
                        </div>
                    @endif

                    Antes de proceder, comprueba el correo para el enlace.
                    Si no has recibido el correo,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Pulsa aqui para otro.</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
