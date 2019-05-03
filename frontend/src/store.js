import Vue from 'vue';
import Vuex from 'vuex';

import boards from '@/modules/boards';
import threads from '@/modules/threads';
import posts from '@/modules/posts';

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    boards,
    threads,
    posts
  }
});
