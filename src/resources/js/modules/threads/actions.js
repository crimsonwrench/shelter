import axios from 'axios';

export const actions = {
    async fetchThreads({ commit }, board) {
        const response = await axios.get('/api/board/'+ board);
        commit('setThreads', response.data.data);
    }
};