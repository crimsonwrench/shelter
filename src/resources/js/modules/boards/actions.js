import axios from 'axios';

export const actions = {
    async fetchBoards({ commit }) {
        const response = await axios.get('/api/boards');
        commit('setBoards', response.data.data);
    }
};