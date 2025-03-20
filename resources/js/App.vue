<template>
    <div class="p-5 d-flex flex-column">
        <div class="btn-group">
            <router-link class="btn btn-outline-primary" :to="{ name: 'get.index' }">Get</router-link>
            <router-link class="btn btn-outline-info" :to="{ name: 'user.login' }">Login</router-link>
            <router-link class="btn btn-outline-info" :to="{ name: 'user.register' }">Register</router-link>
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
