import router from '../../router.js';

/**
 * @module contractors
 */

const state = {
    contractors: null,
    pagination: null,
    config: {
        status: 0,
    },
    params: {
        page: 1,
        search: null,
    }
};

const getters = {
    contractors: state => state.contractors,
    config: state => state.config,
    params: state => state.params,
    pagination: state => state.pagination,
};

const mutations = {
    setContractors(state, contractors) {
        state.contractors = contractors;
    },
    setPagination(state, pagination) {
        state.pagination = pagination;
    },
    setStatus(state, status) {
        state.config.status = status;
    }
}

const actions = {
    getData({commit, state}) {
        axios
            .get('/api/contractors', {params: state.params})
            .then(res => {
                commit('setContractors', res.data.data);
                commit('setPagination', res.data.meta);
                commit('setStatus', res.status);
            })
            .catch(err => {
                commit('setStatus', err.status);
                console.log(err);
            });
    },
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};
