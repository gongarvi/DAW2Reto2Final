<template>
    <div class="container-fluid">

        <div class="row">

            <aside class="col-sm-4 col-md-4 col-lg-2 text-white text-center">

                <div class="make-me-sticky mt-2">

                    <div class="input-group md-form form-sm form-2 pl-0">
                        <input class="form-control my-0 py-1 amber-border" type="search" v-model="busqueda"  placeholder="Buscar.." aria-label="Buscar">
                        <div class="input-group-append">
                            <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fa fa-search text-grey"
                                aria-hidden="true"></i></span>
                        </div>
                    </div>

                    <div v-for="especialidad in arrayespecialidades" :key="especialidad.id" >
                        <button v-bind:style="{ backgroundColor: especialidad.color }" class="btn w-100 mt-2 text-light" @click="filtrarMujeres(especialidad.nombre)"> {{  especialidad.nombre }}</button>
                    </div>
                    <button class="btn btn-light w-100 mt-2" @click="filtrarMujeres('')">Todo</button>

                </div>

            </aside>
            <main class="col-sm-8 col-md-8 col-lg-10 d-flex flex-wrap">

                <div class="card m-2" style="width: 18rem; height:25rem;" v-for="mujer in arrayMostrarMujeres" :key="mujer.id" v-bind:style="{ backgroundColor: mujer.especialidad.color }" @click="MostrarMujer(mujer.nombre, mujer.apellidos,mujer.nacimiento, mujer.fallecido, mujer.nacionalidad, mujer.especialidad.nombre, mujer.descripcion, mujer.foto)" data-toggle="modal" data-target="#myModal" title="Saber mas.">
                    <img class="card-img-top img-mujeres" style="height: 18rem;" alt="foto" v-bind:src="(mujer.foto!=null&&mujer.foto!=='')?'assets/Fotos_mujeres/' + mujer.foto:'assets/Fotos_mujeres/sinfoto.jpg'" />
                    <div class="card-body">
                        <h4 class="card-title">{{mujer.nombre}}</h4>
                        <h5 class="card-text">{{mujer.apellidos}}</h5>
                    </div>
                </div>

                 <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content text-dark">
                            <div class="modal-header">
                            <h4 class="modal-title"></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body text-center">
                                <img id="foto-modal" class="margin-auto rounded" alt="Foto">
                                <p id="vida-mujer" class="text-center"></p>
                                <p id="nacionalidad-mujer" class="text-center"></p>
                                <p id="especialidad-mujer" class="text-center"></p>
                                <p id="descripcion-mujer" class="text-justify"></p>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
</template>

<script>
    Vue.config.productionTip = false;
    export default {
        data(){
            return {
                busqueda: '',
                nombre: '',
                arraymujeres:[],
                arrayespecialidades:[],
                especialidadSeleccionada:"",
                arrayMostrarMujeres:[]
            };
        },
        methods:{
            cargarMujeres() {
                let me = this;
                let url = "api/mujeres";
                window.axios
                    .get(url)
                    .then(function (response) {
                        me.arraymujeres = response.data;
                        me.arrayMostrarMujeres=response.data;
                    })
                    .catch(function (error) {
                    console.log(error);
                    });
            },
            cargarEspecialidades() {
                let me = this;
                let url = "api/especialidades";
                window.axios
                    .get(url)
                    .then(function (response) {
                    me.arrayespecialidades = response.data;
                    })
                    .catch(function (error) {
                    console.log(error);
                    });
            },
            filtrarMujeres(especialdidad) {
                this.especialidadSeleccionada=especialdidad;
            },
            MostrarMujer(nombre, apellidos, nacimiento, fallecido, nacionalidad, especialidad, descripcion, foto){
                document.getElementsByClassName("modal-title")[0].innerHTML=nombre+" "+apellidos;
                document.getElementById("vida-mujer").innerHTML=nacimiento+" - "+fallecido;
                document.getElementById("foto-modal").src ="assets/Fotos_mujeres/"+foto;
                document.getElementById("nacionalidad-mujer").innerHTML="<b>Nacionalidad:</b> "+nacionalidad;
                document.getElementById("especialidad-mujer").innerHTML="<b>Especialidad:</b> "+especialidad;
                document.getElementById("descripcion-mujer").innerHTML="<b>Descripcion:</b> "+descripcion;
            },
            buscarMujer() {
                if(this.especialidadSeleccionada!=""){
                    this.arrayMostrarMujeres=this.arraymujeres.filter((mujer) =>
                        (mujer.nombre.toUpperCase().includes(this.busqueda.toUpperCase()) || mujer.apellidos.toUpperCase().includes(this.busqueda.toUpperCase()))
                        && mujer.especialidad.nombre===this.especialidadSeleccionada);
                }
                else{
                    this.arrayMostrarMujeres = this.arraymujeres.filter((mujer) => mujer.nombre.toUpperCase().includes(this.busqueda.toUpperCase()) || mujer.apellidos.toUpperCase().includes(this.busqueda.toUpperCase()));
                }
            },
            irArriba(){
                $('.ir-arriba').click(function(){
                    $('body,html').animate({ scrollTop:'0px' },1000);
                });
                $(window).scroll(function(){
                    if($(this).scrollTop() > 0){
                        $('.ir-arriba').slideDown(600);
                    }else{
                        $('.ir-arriba').slideUp(600);
                    }
                });
                $('.ir-abajo').click(function(){
                    $('body,html').animate({ scrollTop:'1000px' },1000);
                });
            }

        },
        computed: {

        },
        watch:{
            especialidadSeleccionada:function(){
                this.buscarMujer();
            },
            busqueda:function(){
                this.buscarMujer();
            }
        },
        mounted() {
            this.cargarMujeres();
            this.cargarEspecialidades();
            this.irArriba();

        }
    }
</script>
<style>
    /* *{
        font-family: 'Times New Roman', Times, serif;
    } */
    .make-me-sticky {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        padding: 0 0px;
    }
    .card{
        transition: all 1s;
    }
    .card:hover{
        box-shadow: 2px 2px 5px 5px #808080;
    }
    .img-mujeres{
        -webkit-box-shadow: 0 8px 6px -6px black;
	    -moz-box-shadow: 0 8px 6px -6px black;
	    box-shadow: 0 8px 6px -6px black;
    }
    .modal img{
        width: 20em;
        height: auto;
    }
    @media screen and (max-width: 600px) {
        .modal img{
            width: 15em;
            height: auto;
        }
    }
</style>
