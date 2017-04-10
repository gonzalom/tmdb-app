// import router from './routes'
// import App from './App.vue'

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import router from './routes'

window.eventHub = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(VueRouter, axios);

// Vue.component('example', require('./components/Example.vue'));
Vue.component('searchMovie', require('./components/SearchMovie.vue'));

const app = new Vue({
    // el: '#app',
    router
}).$mount('#app');
