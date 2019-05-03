import axios from 'axios';

export default {
  async fetchBoards({ commit }) {
    const response = await axios.get(
      'boards'
    );

    commit('setBoards', response.data.data);
  },
  async fetchCurrentBoard({ commit }, board) {
    const response = await axios.get(
      `board/${board}`
    );
    commit('setCurrentBoard', response.data.data);
  }
};
