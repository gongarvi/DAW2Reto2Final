 //alert(mujercitas[1].nombre);
    var nombresM = [];
    var fotosM = [];

    var mujercitas=JSON.parse(localStorage.getItem("mujeres"));


    for(i=0; i<mujercitas.length; i++){

        nombresM.push(mujercitas[i].nombre+" "+mujercitas[i].apellidos);
        fotosM.push(mujercitas[i].foto);

    }
    //Parte del Juego
    var juego;
   juego = (function(){
        numElementos = fotosM.length-1;

        imagenes = new Array();
        arraydescripcion = new Array();
        arraynombres = new Array();
        do{
            index = Math.floor(Math.random() * (numElementos-0+1)) + 0;
            if(index<=numElementos && imagenes.indexOf(fotosM[index]) == -1){

                imagenes.push(fotosM[index]);
                arraynombres.push(nombresM[index]);
                arraydescripcion.push(nombresM[index]);
            }

        }
        while(imagenes.length<numElementos);
    var vidas = 6,
    lista1,lista2;

    //Funcion para crear las cartas
    crearCartas = function(){
        try{

            //var contenedor = document.querySelector('.contenedor');
            var nombres = document.querySelector('.nombres');
            var fotos = document.querySelector('.fotos');
            var item_html = '<div class="item" onclick="clic(this)" data-baraja="{baraja}" data-indice="{indice}"></div>';

            lista1 = distribuirCartas(arraynombres);
            lista2 = (imagenes);

            var cartas_html1 = "";
            var cartas_html2 = "";
            for(var i = 0; i<arraynombres.length; i++){
                //aqui creamos las cartas ocultas y sustituimos sus indices con los nombres de los animales
                cartas_html1 += item_html.replace("{baraja}", 1).replace("{indice}",lista1[i]);
            }
            for(x = 0; x < imagenes.length; x++){
                //aqui creamos las cartas con fotos de los animales e indices sus nombres
                var item_html = '<img class="item" onclick="clic(this)" data-baraja="{baraja}" data-indice="{indice}" src="../assets/Fotos_mujeres/'+imagenes[x]+'" height="100px" >';
                cartas_html2 += item_html.replace("{baraja}", 2).replace("{indice}",arraydescripcion[x]);
            }
            //contenedor.innerHTML = cartas_html;
            nombres.innerHTML = cartas_html1;
            fotos.innerHTML = cartas_html2;

        }catch(error){
            console.log(error);
        }
    },
    //Funcion para ejecutar la accion por cada click que hacemos
    clic = function(element){
        try{
            
            var cartas_activas = document.querySelectorAll(".sin-fondo-item");

            if(cartas_activas.length == 2){
                for(var i = 0; i < cartas_activas.length; i++){
                    cartas_activas[i].classList.remove("sin-fondo-item");
                    cartas_activas[i].innerHTML = "";
                }
                restarVidas();
            }

            if(cartas_activas.length == 1){
               if(cartas_activas[0].dataset.indice == element.dataset.indice
                && cartas_activas[0].dataset.baraja != element.dataset.baraja ){

                    element.innerHTML = "<span class='numero-carta'></span>";
                cartas_activas[0].classList.remove("sin-fondo-item");
                cartas_activas[0].classList.add("checked-item");
                element.classList.add("checked-item");
               }
               else{
                    element.classList.add("sin-fondo-item");
                    element.innerHTML = "<span class='numero-carta'>" + element.dataset.indice + "</span>";
               }
            }else{
                element.classList.add("sin-fondo-item");
                element.innerHTML = "<span class='numero-carta'>" + element.dataset.indice  + "</span>";

            }
                //Si todas cartas estan verificadas, nos saca el mensaje de victoria
            if( document.querySelectorAll(".checked-item").length == (arraynombres.length)*2 ){
                    var mensaje = document.querySelector("#contenedor-mensaje-victoria");
                if(mensaje.classList.contains("ocultar-mensaje")){
                    mensaje.classList.remove("ocultar-mensaje");
                }
                window.$("#guardar").click(function (evt) {
                    console.log("va ha cerrar");
                    window.location.href = '/juegos';
          
                    $arrayMujeresAGuardar = new Array();
                    for (var i = 0; mujercitas.length > i; i++) {
                      $arrayMujeresAGuardar.push(mujercitas[i].id);
                      console.log("puseando mujer");
                    }
                    window.location.href = '/guardarmujerperfil/' + $arrayMujeresAGuardar;
                    console.log("¡¡HAS GANADO!!");
                  });

            }


        }catch(error){
            console.log(error);
        }
    },
    //funcion para restar las vidas por cada fallo que cometemos
    restarVidas = function(){
        try{
            if(vidas == 1){

                var mensaje = document.querySelector("#contenedor-mensaje-derrota");
               if(mensaje.classList.contains("ocultar-mensaje")){
                    mensaje.classList.remove("ocultar-mensaje");
               }
            }
            document.querySelector(".puntos").querySelectorAll("img")[0].remove();
            --vidas;

        }catch(error){
            console.log(error);
        }
    }
    //Funcion para repartir las cartas aleatoriamente
    distribuirCartas = function(arr) {
        try{
             var i,j, temp;
             for(i = arr.length - 1; i > 0; i--){
                 j = Math.floor(Math.random() * (i + 1));
                 temp = arr[i];
                 arr[i] = arr[j];
                 arr[j] = temp;
             }
             return new Array().concat(arr);
        }catch(error){
             console.log(error);
        }
     },

    init = function(){
        try{

            crearCartas();
            var botones = document.querySelectorAll(".btn");
            for(var i = 0; i<botones.length; i++){
                botones[i].addEventListener('click', function(){
                    location.reload(true);
                },false)
            }
        }
        catch(error){
            console.log(error);
        }
    };

    return{
        init: init,
        clic: clic
    }
})();window.onload = juego.init();




