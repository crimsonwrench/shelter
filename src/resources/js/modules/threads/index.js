import { actions } from './actions';
import { getters } from './getters';
import { mutations } from './mutations';

const state = {
    threads: []
};

export default {
    state,
    getters,
    actions,
    mutations
}