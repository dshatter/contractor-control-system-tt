/**
 * @module modal
 */

const state = {
    opened: false,
};

const getters = {
    opened: state => state.opened,
};

const mutations = {
    setOpened(state, status) {
        state.opened = status;
    },

};

const actions = {

    open({commit}) {
        commit('setOpened', true);
    },
    close({ commit }) {
        document.activeElement.blur();
        commit('setOpened', false);
    }

};
export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};
