<template>
    <section>
        <div v-if="mujeres!=null && mujeres.length!=0" id="ruleta" class="mb-5 text-center p-2">
            <h2 class="text-light">Escogiendo mujer, espere...</h2>
            <img id="fotoRuleta" v-for="(mujer,indice) in mujeres"
                 v-if="indice==index" v-bind:src="(mujeres[index].foto!=null&&mujeres[index].foto!=='')?'../../../assets/Fotos_mujeres/'+mujer.foto:'../../../imagae/placeholder-usuario'"
                 class="rounded mx-auto d-block border border-dark " width="400px" height="400px">
        </div>
        <div v-if="mujeres!=null && mujeres.length!=0 && index<mujeres.length" id="infoMujer" class="card text-center mx-auto" style="width: 75%;display: none;">
            <div class="card-body">
                <h5 class="card-title">{{mujeres[index].nombre}} {{mujeres[index].apellidos}}</h5>
                <h6 class="card-title">{{mujeres[index].nacionalidad}}</h6>
                <h6 class="card-title">{{((mujeres[index].nacimiento==null)||(mujeres[index].nacimiento===""))?'?':mujeres[index].nacimiento}} - {{((mujeres[index].fallecimiento==null)||(mujeres[index].fallecimiento===""))?'?':mujeres[index].fallecimiento}}</h6>
                <p class="card-text text-justify">{{ mujeres[index].descripcion }}</p>
            </div>
            <div class="card-footer">
                <button v-if="mujeresSeleccionadas.length>=cantidadMinima" @click="jugar" class="btn btn-danger">JUGAR</button>
                <button v-if="mujeresSeleccionadas.length<cantidadMinima" @click="siguiente" class="btn btn-danger">SIGUIENTE</button>
            </div>
        </div>
    </section>
</template>
<script>
    export default {
        name:"ruleta",
        data(){
            return{
                mujeres:[],
                index:0,
                cantidadMinima:0,
                especialidad:0,
                mujeresSeleccionadas:[],
                juego:"",
                vueltas:0
            }
        },
        beforeMount() {
            localStorage.removeItem("mujeres");
            let url=window.location.href.split("/");
            var especialidad=url[5];
            this.juego=url[6];
            switch (this.juego){
                case "Millonario":
                    this.cantidadMinima=10;
                    break;
                case "Buscaminas":
                    this.cantidadMinima=1;
                    break;
                case "Tresenraya":
                    this.cantidadMinima=6;
                    break;
                case "Puzzle":
                    this.cantidadMinima=1;
                    break;
                case "Matching":
                    this.cantidadMinima=6;
                    break;
            }
            if(!isNaN(especialidad) && especialidad>0 && especialidad<=9){
                this.especialidad=especialidad;
            }
        },
        methods:{
            obtenerMujeres(){
                if(this.especialidad!==0){
                    this.obtenerMujeresPorEspecializacion();
                }else{
                    this.obtenerMujeresAleatorias();
                }

            },
            obtenerMujeresAleatorias(){
                window.axios.get(window.location.protocol+"//"+window.location.host+"/api/mujeres/"+3+"/"+0)
                .then((response)=>{
                    if(response.status==200){
                        this.mujeres=response.data;
                        this.girarRuleta();

                    }else{
                        console.error("Error code: "+response.status+", "+response.data);
                    }
                })
                .catch((error)=>{
                    console.error(error);
                })
            },
            obtenerMujeresPorEspecializacion(){
                console.log(window.location.protocol+"//"+window.location.host+"/api/mujeres/"+3+"/"+0);
                window.axios.get(window.location.protocol+"//"+window.location.host+"/api/mujeres/"+3+"/"+this.especialidad)
                    .then((response)=>{
                        if(response.status==200){
                            this.mujeres=response.data;
                            this.girarRuleta();
                        }else{
                            console.error("Error code: "+response.status+", "+response.data);
                        }
                    })
                    .catch((error)=>{
                        console.error(error);
                    })
            },
            girarRuleta(){
                var interval = setInterval(()=>{
                    if(this.index<this.mujeres.length-1){
                        this.index++;
                    }else{
                        this.index=0;
                    }
                },500);
                setTimeout(()=>{
                    clearInterval(interval);
                    if(!this.existeMujer(this.index)){
                        this.mujeresSeleccionadas.push(this.mujeres[this.index]);
                        $("#infoMujer").show();
                    }else{
                        if(this.vueltas>5 && this.especialidad!=0){
                            alert("No hay mas muejeres para poder completar el juego. Se ha cambiado la especializacion a todas");
                            this.especialidad=0;
                        }else{
                            this.vueltas++;
                        }
                        this.obtenerMujeres();
                    }
                },2500);
            },
            existeMujer(){
                if(this.mujeresSeleccionadas.filter(mujer=>mujer.id==this.mujeres[this.index].id).length>0) {
                    return true;
                }
                return false;
            },
            jugar(){
                localStorage.setItem("mujeres",JSON.stringify(this.mujeresSeleccionadas));
                location.href=location.protocol+"//"+location.host+"/juegos/"+this.juego.toLowerCase();
            },
            siguiente(){
                $("#infoMujer").hide();
                this.obtenerMujeres();
            },

        },
        mounted(){
            this.obtenerMujeres();
        }
    }
</script>
<style scoped>

</style>
