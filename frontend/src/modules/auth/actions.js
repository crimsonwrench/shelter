import axios from 'axios';

export default {
  retrieveToken({ commit }, credentials) {
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
};
