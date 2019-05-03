import axios from 'axios';

export default {
  async fetchThreads({ commit }, board) {
    const response = await axios.get(
      `board/${board}/threads`
    );

    commit('setThreads', response.data.data);
  }
};
