require('./bootstrap');

window.Vue = require('vue');

Vue.component('buscaminas', require('./components/App').default);
Vue.component('tablero', require('./components/Tablero').default);
Vue.component('cuadro', require('./components/Cuadro').default);

const app = new Vue({
    el: '#app',
    methods: {
       
    },
});
