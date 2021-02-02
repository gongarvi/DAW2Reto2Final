
window.Vue = require('vue');
require("./bootstrap.js");

const app = new Vue({
    el: '#app',
    methods: {
        checkImages(event) {
            console.log(event);
            event.target.src = "image/placeholder.png"
        },
        pulsarboton: function(nombreJuego){
            var especialidad = document.getElementById("selectEspecialidad").value;
            window.location.href = '/juegos/ruleta/'+especialidad+"/"+nombreJuego;
        },
    },
});
