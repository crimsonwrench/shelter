import axios from 'axios';

export default {
  async fetchThreads({ commit }, boardName) {
    const response = await axios.get(
      `board/${boardName}`
    );

    commit('setThreads', response.data.data);
  }
};
