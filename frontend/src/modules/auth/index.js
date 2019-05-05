import actions from './actions';
import getters from './getters';
import mutations from './mutations';

const state = {
  token: localStorage.getItem('access_token') || null
};

export default {
  state,
  getters,
  actions,
  mutations
};
