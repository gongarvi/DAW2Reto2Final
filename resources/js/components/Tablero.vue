<template>
  <div class="tablero">
    <div class="panel">
      <div class="marcador minas-restantes">
        {{ minasRestantesCifras }}
      </div>
      <div class="cara">
        <span @click="iniciarnivel">{{ cara }}</span>
      </div>
      <div class="marcador segundos">{{ segundosCifras }}</div>
    </div>
    <div
      class="matriz"
      id="matrizid"
      v-bind:style="{ backgroundImage: 'url(' + foto + ')' }"
    >
      <cuadro
        @onCambiarMinasRestantes="cambiarMinasRestantes"
        @onActivar="activarCuadro"
        :info="item"
        v-for="(item, index) in cuadros"
        :key="index"
        :style="'grid-row:' + item.fila + '; grid-colmun' + item.colmuna + ';'"
      />
    </div>
  </div>
</template>
<script>
    import Cuadro from './Cuadro.vue';
    export default {
        components: {
            Cuadro
        },
        data() {
            return {
                cara: '👩',
                cuadros: [],
                colores: ['', 'uno', 'dos', 'tres', 'cuatro', 'cinco','seis'],
                nivelIntermedio: {
                    nivel: 2,
                    filas: 16,
                    columnas: 16,
                    minas: 40
                },
                nivelActual: null,
                minas: [],
                minasRestantes: 0,
                segundos: 0,
                inicio: false,
                timer: null,
                jugando: false,
                cuadrosRestantes: 0,
                foto:"",
                mujeres:null
            }
        },
        computed: {
            minasRestantesCifras() {
                let cifras = this.minasRestantes.toString();
                if (cifras.length == 1) {
                    cifras = '00' + cifras;
                } else if (cifras.length == 2) {
                    cifras = '0' + cifras;
                }
                return cifras
            },
            segundosCifras() {
                let cifras = this.segundos.toString();
                if (cifras.length == 1) {
                    cifras = '00' + cifras;
                } else if (cifras.length == 2) {
                    cifras = '0' + cifras;
                }
                return cifras
            },
            imageRandom() {
                var imagen = this.imagenes[Math.floor(this.imagenes.length * Math.random() * 3)]
                return imagen;
            },
        },
        beforeMount(){
            this.mujeres=JSON.parse(localStorage.getItem("mujeres"));
            if(this.mujeres!=null && this.mujeres.length>0){
                this.foto=location.protocol+"/"+location.host+"../../../assets/Fotos_mujeres/"+this.mujeres[0].foto;
                console.log(this.foto);
                this.nivelActual = this.nivelIntermedio
            this.iniciarnivel()
            }
            else{
                console.log("NOT FOUND IMAGE");
            }
        },
        methods: {
           
            detenertiempo() {
                if (this.timer) {
                    clearInterval(this.timer)
                }
            },

            iniciarnivel() {
                 var mensaje;
                let arrayPreguntas = new Array();
                $.get("/api/preguntas/" + this.mujeres[0].id, function (data) {
                    arrayPreguntas.push(data);
                })
                this.botonIzquierdo = false;
                this.botonDerecho = false;
                this.cara = '👩'
                this.detenertiempo();

                

                this.minasRestantes = this.nivelIntermedio.minas;
                this.segundos = 0;
                this.inicio = false;



                let filas = this.nivelIntermedio.filas;
                let columnas = this.nivelIntermedio.columnas;
                let totalcuadros = filas * columnas;

                this.cuadrosRestantes = totalcuadros - this.nivelIntermedio.minas;

                this.cuadros = []
                let indices = []
                for (let i = 0; i < totalcuadros; i++) {
                    let cuadro = {
                        inicial: true,
                        bandera: false,
                        valor: "",
                        fila: Math.floor(i / columnas) + 1,
                        columna: (i % columnas) + 1,
                        vecinos: [],
                        claseValor: ''
                    }
                    this.cuadros.push(cuadro);

                    indices.push(i);
                }
                for (let i = 0; i < this.nivelIntermedio.minas; i++) {
                    let posicion = Math.floor(Math.random() * (indices.length - 1));
                    let indice = indices[posicion];
                    this.cuadros[indice].valor = '💣';
                    this.minas.push(this.cuadros[indice]);
                    indices.splice(posicion, 1);
                }
                for (let i = 0; i < totalcuadros; i++) {
                    let cuadro = this.cuadros[i];
                    if (cuadro.columna == 1) {
                        if (cuadro.fila == 1) {
                            cuadro.vecinos.push(i + 1);
                            cuadro.vecinos.push(i + columnas);
                            cuadro.vecinos.push(i + columnas + 1);
                        } else if (cuadro.fila == filas) {
                            cuadro.vecinos.push(i + 1);
                            cuadro.vecinos.push(i - columnas);
                            cuadro.vecinos.push(i - columnas + 1);
                        } else {
                            cuadro.vecinos.push(i + 1);
                            cuadro.vecinos.push(i + columnas);
                            cuadro.vecinos.push(i + columnas + 1);
                            cuadro.vecinos.push(i - columnas);
                            cuadro.vecinos.push(i - columnas + 1);
                        }
                    } else if (cuadro.columna == columnas) {
                        if (cuadro.fila == 1) {
                            cuadro.vecinos.push(i - 1);
                            cuadro.vecinos.push(i + columnas);
                            cuadro.vecinos.push(i + columnas - 1);
                        } else if (cuadro.fila == filas) {
                            cuadro.vecinos.push(i - 1);
                            cuadro.vecinos.push(i - columnas);
                            cuadro.vecinos.push(i - columnas - 1);
                        } else {
                            cuadro.vecinos.push(i - 1);
                            cuadro.vecinos.push(i + columnas);
                            cuadro.vecinos.push(i + columnas - 1);
                            cuadro.vecinos.push(i - columnas);
                            cuadro.vecinos.push(i - columnas - 1);
                        }
                    } else {
                        if (cuadro.fila == 1) {
                            cuadro.vecinos.push(i - 1);
                            cuadro.vecinos.push(i + 1);
                            cuadro.vecinos.push(i + columnas - 1);
                            cuadro.vecinos.push(i + columnas);
                            cuadro.vecinos.push(i + columnas + 1);
                        } else if (cuadro.fila == filas) {
                            cuadro.vecinos.push(i - 1);
                            cuadro.vecinos.push(i + 1);
                            cuadro.vecinos.push(i - columnas - 1);
                            cuadro.vecinos.push(i - columnas);
                            cuadro.vecinos.push(i - columnas + 1);
                        } else {
                            cuadro.vecinos.push(i - 1);
                            cuadro.vecinos.push(i + 1);
                            cuadro.vecinos.push(i + columnas - 1);
                            cuadro.vecinos.push(i + columnas);
                            cuadro.vecinos.push(i + columnas + 1);
                            cuadro.vecinos.push(i - columnas - 1);
                            cuadro.vecinos.push(i - columnas);
                            cuadro.vecinos.push(i - columnas + 1);
                        }
                    }
                    if (cuadro.valor != '💣') {
                        let minas = cuadro.vecinos.filter(v => this.cuadros[v].valor == '💣').length;

                        if (minas > 0) {
                            cuadro.valor = minas;
                            cuadro.claseValor = 'numero ' + this.colores[minas];
                        }
                    }

                }
                this.jugando = true;
            },
            activarCuadro(cuadro) {
                if (this.jugando && cuadro.inicial && !cuadro.bandera) {
                    cuadro.inicial = false;
                    if (!this.inicio) {
                        this.timer = setInterval(() => {
                            this.segundos++;
                        }, 1000)
                        this.inicio = true;
                    }
                    if (cuadro.valor == '💣') {
                        //Explosión
                        this.explosion(cuadro);
                    } else {
                        this.cuadrosRestantes--;
                        if (this.cuadrosRestantes <= 0) {
                            this.ganar();
                        } else if (cuadro.valor == '') {
                            cuadro.vecinos.forEach(v => {
                                this.activarCuadro(this.cuadros[v])
                            });
                        }
                    }

                }
            },
            cambiarMinasRestantes(cuadro) {
                if (this.jugando) {
                    cuadro.bandera = !cuadro.bandera;
                }
                this.minasRestantes += cuadro.bandera ? -1 : 1;
            },
            explosion(cuadro) {
                this.jugando = false;
                this.detenertiempo();

                this.minas.forEach(mina => {
                    if (!mina.bandera) {
                        mina.inicial = false;
                    }
                })
                let banderas = this.cuadros.filter(c => c.bandera)
                banderas.forEach(c => {
                    if (c.valor != '💣') {
                        c.bandera = false;
                        c.valor = '❌'
                        c.inicial = false;
                    }
                })
                cuadro.valor = '💥';
                this.cara = '😡';
                var mensaje;

                mensaje = document.querySelector("#contenedor-mensaje-derrota");
						if (mensaje.classList.contains("ocultar-mensaje")) {
							mensaje.classList.remove("ocultar-mensaje");
						}
						window.$("#otrapartida").click(function (evt) {
							console.log("va ha cerrar");
							window.location.href = '/juegos';
						});
            },
            ganar() {
                this.jugando = false;
                this.detenertiempo();
                this.minas.forEach(mina => {
                    mina.bandera = true
                });
               console.log("LO RESOLVISTE COMPADRE!!")
				mensaje = document.querySelector("#cuestionario");
				mensaje.style.display = "block";
				document.getElementById("pregunta").innerHTML = arrayPreguntas[0].pregunta;
				for (i = 0; i < arrayPreguntas[0].respuestas.length; i++) {
					$('#respuestas').append($('<option />', {
						text: arrayPreguntas[0].respuestas[i].respuesta,
						value: arrayPreguntas[0].respuestas[i].correcta,
					}));
				}
				window.$("#validar").click(function (evt) {
					mensaje.style.display = "none";
					if (document.getElementById("respuestas").value == "true") {
						//Sube la pava al base de datos mujeres pasadas para fotoperfil
						mensaje = document.querySelector("#contenedor-mensaje-victoria");
						if (mensaje.classList.contains("ocultar-mensaje")) {
							mensaje.classList.remove("ocultar-mensaje");
						}
						window.$("#guardar").click(function (evt) {
							console.log("va ha cerrar");
							$arrayMujeresAGuardar = new Array();
							$arrayMujeresAGuardar.push(this.mujeres[0].id);

							window.location.href = '/guardarmujerperfil/' + $arrayMujeresAGuardar;
                        });
                    }
                });
                    
                console.log("ganaste");
                this.minasRestantes = 0;
                this.cara = '🥳';
            }
        }
    }

</script>
<style>
@import url("https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@500&display=swap");

html {
  font-family: "Roboto Mono", monospace;
}

.numero {
  font-size: 20px;
  font-weight: bold;
  font-family: "Roboto Mono", monospace;
}

.uno {
  color: blue;
}

.dos {
  color: green;
}

.tres {
  color: red;
}

.cuatro {
  color: darkblue;
}

.cinco {
  color: yellow;
}
.seis {
  color: hotpink;
}

.tablero {
  display: grid;
  justify-content: center;
  /*background-color: #bdbdbd;*/
  background-color: #595454;
  padding: 10px;
  user-select: none;
}

.niveles {
  display: grid;
  grid-auto-flow: column;
  grid-gap: 10px;
  font-size: 24px;
  padding: 5px;
  justify-content: start;
  align-items: center;
}

.nivel {
  width: 32px;
  height: 32px;
  color: #5c5c5c;
  text-align: center;
  cursor: pointer;
}

.nivel-seleccionado {
  color: #fff !important;
  background-color: #5f9cff;
  border-width: 2px;
  border-radius: 50%;
  cursor: default;
}

.panel {
  display: grid;
  grid-auto-flow: column;
  font-size: 30px;
  margin-top: 10px;
  padding: 10px;
  border-top-color: #818181;
  border-left-color: #818181;
  border-bottom-color: #fff;
  border-right-color: #fff;
  border-style: solid;
  border-width: 1px;
}

.marcador {
  background-color: black;
  color: red;
  height: 40px;
}

.minas-restantes {
  justify-self: start;
}

.cara {
  display: grid;
  justify-content: center;
  align-items: center;
  justify-self: center;
  width: 40px;
  height: 40px;
  font-size: 24px;
  border-top-color: #fff;
  border-left-color: #fff;
  border-bottom-color: #818181;
  border-right-color: #818181;
  border-style: solid;
  border-width: 2px;
  cursor: pointer;
}

.segundos {
  justify-self: end;
}

.matriz {
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center center;
  display: grid;
  padding: 2px;
  margin-top: 10px;
  border-top-color: #878787;
  border-left-color: #878787;
  border-bottom-color: #fff;
  border-right-color: #fff;
  border-style: solid;
  border-width: 3px;
}
</style>
