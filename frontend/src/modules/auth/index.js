import actions from './actions';
import getters from './getters';
import mutations from './mutations';

const state = {
  token: localStorage.getItem('access_token') || null,
  user: JSON.parse(localStorage.getItem('user'))
};

export default {
  state,
  getters,
  actions,
  mutations
};
