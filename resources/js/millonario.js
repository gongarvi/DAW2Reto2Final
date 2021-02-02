window.Vue = require('vue');
require("./bootstrap.js");
Vue.component('millonario', require('./components/Millonario').default);
Vue.component('pregunta', require('./components/Pregunta').default);
Vue.component('respuesta', require('./components/Respuesta').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

const app = new window.Vue({
    el: '#app',
    methods: {

    },
});
