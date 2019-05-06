export default {
  retrieveToken: (state, token) => (state.token = token),
  destroyToken: (state) => (state.token = null),
  retrieveUser: (state, user) => (state.user = user),
  destroyUser: (state) => (state.user = {})
};
