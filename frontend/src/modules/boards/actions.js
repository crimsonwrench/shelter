import axios from 'axios';

export default {
  fetchBoards({ commit }) {
    axios.get('boards')
      .then(response => {
        commit('setBoards', response.data.data);
      })
      .catch(error => {
        console.log(error);
      });
  },
  fetchCurrentBoard({ commit }, board) {
    axios.get(`board/${board}`)
      .then(response => {
        commit('setCurrentBoard', response.data.data);
      })
      .catch(error => {
        console.log(error);
      });
  }
};
