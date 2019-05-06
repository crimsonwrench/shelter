import axios from 'axios';

export default {
  fetchPosts({ commit }, { board, thread }) {
    axios.get(`board/${board}/thread/${thread}`)
      .then(response => {
        commit('setPosts', response.data.data.posts);
      })
      .catch(error => {
        console.log(error);
      });
  }
};
