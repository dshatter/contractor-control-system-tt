<script>

export default {
    name: 'Login',
    data() {
        return {
            user: {
                email: null,
                password: null,
            },
            token: null,
        };
    },
    methods: {
        login() {
            axios
                .get('/sanctum/csrf-cookie', {})
                .then(response => {

                    axios
                        .post('/api/login', this.user)
                        .then(r => {
                            localStorage.setItem('x_xsrf_token', this.getCookie(r.config.xsrfCookieName));
                            this.$router.push({ name: 'user.index' });
                        })
                        .catch(err => {
                            console.log(err.response.data);
                        });
                });
        },
        getCookie(name) {
            let matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        },
        trimToken(token) {
            return token.replace(/=?$/, '');
        }
    },
};

</script>

<template>
    <section class="login content">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="card-title">Вход в аккаунт</h2>
                <form>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input v-model="user.email" type="email" class="form-control" name="email" placeholder="example@einzelwerk.ru">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Пароль</label>
                        <input v-model="user.password" type="password" class="form-control" name="password" placeholder="************">
                    </div>
                    <button type="submit" @click.prevent="login" value="login" class="btn btn-primary w-100">Войти
                    </button>
                </form>
                <hr class="my-2">
                <span class="text-center">Нет аккаунта? <router-link :to="{ name: 'user.register' }">Зарегистрироваться</router-link></span>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
