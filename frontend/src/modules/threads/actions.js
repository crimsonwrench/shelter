import axios from 'axios';

export default {
  fetchThreads({ commit }, board) {
    axios.get(`board/${board}/threads`)
      .then(response => {
        commit('setThreads', response.data.data);
      })
      .catch(error => {
        console.log(error);
      });
  }
};
