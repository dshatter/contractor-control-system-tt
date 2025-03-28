<template>
    <router-view></router-view>

    <VuePreloader
        background-color="#ffffff"
        color="#000000"
        transition-type="fade-up"
        :loading-speed="10"
        :transition-speed="700"
    >
    </VuePreloader>
</template>

<script>
import { VuePreloader } from 'vue-preloader';
import '../../node_modules/vue-preloader/dist/style.css'
export default {
    components: {
        VuePreloader
    },
    data() {
        return {
            token: null,
        }
    },
    methods: {
        logout() {
            axios.post('/api/logout')
                .then(res => {
                    localStorage.removeItem('x_xsrf_token');
                    this.$router.push({ name: 'user.login' });
                })
                .catch(err => {
                });
        },
        getToken() {
            this.token = localStorage.getItem('x_xsrf_token');
        }
    },
    mounted() {

    },
    updated() {
        this.getToken();
    }
};
</script>
