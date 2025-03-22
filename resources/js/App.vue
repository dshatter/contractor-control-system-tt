<template>
    <div class="btn-group" style="position: absolute; top: 5px;">
        <button v-if="!token" @click.prevent="logout" class="btn btn-outline-dark">Logout</button>
    </div>
    <router-view></router-view>
</template>

<script>
export default {
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
