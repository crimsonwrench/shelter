import axios from 'axios';

export default {
  async fetchBoards({ commit }) {
    const response = await axios.get(
      'boards'
    );

    commit('setBoards', response.data.data);
  }
};
