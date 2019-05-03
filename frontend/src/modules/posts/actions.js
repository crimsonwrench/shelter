import axios from 'axios';

export default {
  async fetchPosts({ commit }, { board, thread }) {
    const response = await axios.get(
      `board/${board}/thread/${thread}`
    );

    commit('setPosts', response.data.data.posts);
  }
};
