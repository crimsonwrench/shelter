require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import {routes} from './routes';

import Boards from './components/Boards';
 
Vue.use(VueRouter);

const router = new VueRouter({
    routes
})

const app = new Vue({
    el: '#app',
    router,
    components: {
        Boards
    }
});
