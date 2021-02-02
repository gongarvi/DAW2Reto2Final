<div class="card">
    <div class="card-body">
        <div class="card-front">
            <img style="width:65%;height:auto;" src="{{$juego['imagen']}}" alt="Imagen {{$juego['nombre']}}" onerror="javascript:this.src='{{url('/image/placeholder.png')}}'">
            <h2>Nivel {{$juego['id']}}</h2>
        </div>
        <div class="card-back">
                <div class="w-100 h-100 p-3 p-lg-5">
                    <h5 id="nombreJuego"class="card-title">{{ucfirst($juego["nombre"])}}</h5>
                    <p class="card-text">{{$juego["descripcion"]}}</p>
                    <button class="btn btn-dark text-light" @click="pulsarboton('{{ucfirst($juego["nombre"])}}')">Entrar</button>
                </div>
        </div>
    </div>
</div>

