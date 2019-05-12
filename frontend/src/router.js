import Vue from 'vue';
import Router from 'vue-router';
import axios from 'axios';

import Home from '@/views/Home.vue';
import Board from '@/views/Board.vue';
import Thread from '@/views/Thread.vue';

import Login from '@/views/auth/Login.vue';
import Logout from '@/views/auth/Logout.vue';
import Register from '@/views/auth/Register.vue';

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
      path: '/b/:board',
      name: 'board',
      component: Board
    },
    {
      path: '/b/:board/:thread',
      name: 'thread',
      component: Thread
    },
    {
      path: '/login',
      name: 'login',
      component: Login,
      meta: {
        requiresUnauth: true
      }
    },
    {
      path: '/logout',
      name: 'logout',
      component: Logout,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/register',
      name: 'register',
      component: Register,
      meta: {
        requiresUnauth: true
      }
    }
  ]
});
