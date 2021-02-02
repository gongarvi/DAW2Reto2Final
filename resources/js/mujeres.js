window.onload=(function(){
    require("./bootstrap.js");

    window.Vue = require('vue');

    Vue.component('mujeres-component', require('./components/Mujeres.vue').default);


    const mujeres = new Vue({
        el: '#mujeres',
        methods: {
            checkImages(event) {
                console.log(event);
                event.target.src = "image/placeholder.png"
            },
            pulsarboton: function(nombreJuego){
                var Especialidad = document.getElementById("selectEspecialidad").value;
                window.location.href = '/juegos/ruleta/'+Especialidad+"/"+nombreJuego;
            },
        },
    });


});

