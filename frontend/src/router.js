import Vue from 'vue';
import Router from 'vue-router';
import axios from 'axios';

import Home from './views/Home.vue';
import Board from './views/Board.vue';

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
      path: '/b/:boardName',
      name: 'board',
      component: Board
    }
  ]
});
