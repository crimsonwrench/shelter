export default {
  loggedIn(state) {
    return state.token !== null;
  },
  user: (state) => state.user
};
