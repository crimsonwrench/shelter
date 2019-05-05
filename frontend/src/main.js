// Initialize application
import Vue from 'vue';
import App from '@/App.vue';

import router from '@/router';
import store from '@/store';
import '@/styles/global.scss';

// import vue modals
import VModal from 'vue-js-modal';

// import booststrap-vue
import BootstrapVue from 'bootstrap-vue';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

Vue.use(BootstrapVue);
Vue.use(VModal);

Vue.config.productionTip = false;

new Vue({
  router,
  store,
  render: function (h) { return h(App); }
}).$mount('#app');
