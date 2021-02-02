@extends("layouts.clear")

@section("head-extras")

    <link rel="stylesheet" href="{{asset("css/index.css")}}">
    <script src="{{asset('js/app.js')}}"></script>

@endsection
@section("header")
    <img src="image/feminina.png" alt="feminina">
    <p id="logo">Desayunos feministas</p>
@endsection
@section("content")

    <div class="container container-fluid">
        <div class="row m-auto">
            <div class="col-12 col-lg-4 p-0 text-center">
                <img class="m-auto" src="{{asset("image/feminina.png")}}" alt="feminina">
                <h1 class="m-auto text-center" id="logo">Desayunos feministas</h1>

            </div>
            <div class="col-12 col-lg-8 p-0 mt-5 m-lg-auto">
                <ul class="list-group-flush p-0 my-auto">
                    @guest
                    @if (Route::has('login'))
                        <li class="list-group-item border-0 bg-transparent"><a class="btn btn-outline-light w-100" href="{{route("login")}}">Iniciar sesión / Registrarse</a></li>
                    @endif
                    @else
                        <li class="list-group-item border-0 bg-transparent"><a class="btn btn-outline-light w-100" href="{{route("perfil",Auth::user()->id)}}">Perfil de {{ Auth::user()->name }}</a></li>
                    @endguest

                    <li class="list-group-item border-0 bg-transparent"><a class="btn btn-outline-light w-100" href="{{route("mujeres")}}">Galeria</a></li>
                    @guest
                    @if (Route::has('login'))
                    <li class="list-group-item border-0 bg-transparent" data-toggle="modal" data-target="#myModal"><a class="btn btn-outline-light w-100">Jugar</a></li>
                    @endif
                    @else
                        <li class="list-group-item border-0 bg-transparent"><a class="btn btn-outline-light w-100" href="{{route("juegos")}}">Jugar</a></a></li>
                        @if (Auth::user()->administrador ==1)                  
                        <li class="list-group-item border-0 bg-transparent"><a class="btn btn-outline-light w-100" href="{{route("panel")}}">Administrar</a></li>
                        @endif
                    @endguest
                </ul>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content text-dark">
                                <div class="modal-body text-center">
                                    <h4><b>Para poder jugar debe iniciar sesion o registrarse</b></h4>
                                    
                                    <a href="{{route("login")}}"><button type="submit" class="btn btn-primary mt-5">Iniciar sesion/Registrarse</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 text-justify">
                <p>Queremos darte la bienvenida a nuestro sitio web. </p> 
                <p>Suponiendo que es la primera vez que entras aquí y no sabes de qué trata la web y quiénes somos, no te preocupes en seguida te lo aclaramos.</p>
                <p>Cabe destacar de inicio que somos una asociación feminista (Desayunos Feministas) ubicada en Santander.</p> 
                <p> Una de nuestras misiones es recopilar información sobre las mujeres que han trabajado en varios ámbitos y han destacado por sus ideologías, carácter…y que a nivel social son poco conocidas.
                 y a raíz de esto hemos creado este sitio web para dar visibilidad a esas mujeres, la web incluye una variedad juegos con la información de las damas.</p>
                <p>Que lo disfrutes.</p>
            </div>
        </div>
       <div class="container">
       <h3 style="margin: 0 auto; text-align:center">DESARROLLADORES</h3><hr>
        <div class="row">
               
               <div class="col-2">Sayeeda Azad Shirin</div>
               <div class="col-2">David Chacon</div>
               <div class="col-3">Unai Martin</div>
               <div class="col-3">Ordoño Ndong</div>
               <div class="col-2">Jon Ander Aristimuño</div>
              
        </div>
       </div>
    </div>
@endsection
