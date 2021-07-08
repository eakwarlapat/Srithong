require('./bootstrap');

import Vue from 'vue'
import Vuelidate from 'vuelidate'
import router from './routes';
import VueRouter  from 'vue-router';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(VueSweetalert2);
Vue.use(Vuelidate);


Vue.component('index-component', require('./Index.vue').default);


const app = new Vue({
    el: '#app',
    router
});
