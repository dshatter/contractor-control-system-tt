<template>
    <div class="btn-group" style="position: absolute; top: 5px;">
        <router-link class="btn btn-outline-primary" :to="{ name: 'get.index' }">Get</router-link>
        <router-link class="btn btn-outline-info" :to="{ name: 'user.login' }">Login</router-link>
        <router-link class="btn btn-outline-info" :to="{ name: 'user.register' }">Register</router-link>
    </div>
    <router-view></router-view>
</template>

<script>
export default {
    mounted() {
        console.log('Component mounted.');
    },
};
</script>
