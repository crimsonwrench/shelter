import axios from 'axios';

export default {
  destroyToken({ commit, state, getters }) {
    if (getters.loggedIn) {
      axios.defaults.headers.common['Authorization'] = `Bearer ${state.token}`;

      return new Promise((resolve, reject) => {
        axios.post('/logout')
          .then(response => {
            localStorage.removeItem('access_token');
            resolve(response);

            commit('destroyToken');
          });
      });
    }
  },
  retrieveToken({ commit, getters }, credentials) {
    if (!getters.loggedIn) {
      return new Promise((resolve, reject) => {
        axios.post('/login', {
          username: credentials.username,
          password: credentials.password
        })
          .then(response => {
            const token = response.data.access_token;
            localStorage.setItem('access_token', token);
            resolve(response);

            commit('retrieveToken', token);
          })
          .catch(error => {
            console.log(error);
            reject(error);
          });
      });
    }
  },
  retrieveUser({ commit, state }) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${state.token}`;

    axios.get('/user')
      .then(response => {
        localStorage.setItem('user', JSON.stringify(response.data));
        commit('retrieveUser', response.data);
      });
  },
  destroyUser({ commit, getters }) {
    localStorage.removeItem('user');
    commit('destroyUser');
  }
};
