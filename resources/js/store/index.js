import { createStore } from 'vuex';
import contractors from './modules/contractors.js';
import modal from './modules/modal.js';

export default createStore({
    state() {

    },
    mutations: {

    },
    modules: {
        contractors,
        modal,
    },
});
