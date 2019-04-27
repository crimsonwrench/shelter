import Vue from 'vue';
import Router from 'vue-router';
import axios from 'axios';

import Home from './views/Home.vue';

Vue.use(Router);

// Initialize axios
axios.defaults.baseURL = process.env.VUE_APP_API_URL || '/api/';
axios.defaults.headers.post['Content-Type'] = 'application/json';


export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: function () {
        return import(/* webpackChunkName: "about" */ './views/About.vue');
      }
    }
  ]
});
