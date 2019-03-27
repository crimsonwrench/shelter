require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import {routes} from './routes';
import store from './store';

Vue.use(VueRouter);

import App from './App';

const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    el: '#app',
    router,
    store,
    components: { App }
});
