window.Vue = require('vue');
require("./bootstrap.js");
Vue.component('ruleta', require('./components/Ruleta').default);

const app = new Vue({
    el: '#ruleta',
    methods: {
    },
});
