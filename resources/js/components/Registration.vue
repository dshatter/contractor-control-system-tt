<script>
export default {
    name: "Registration",

    data() {
        return {
            user: {
                email: null,
                password: null,
            }
        }
    },
    methods: {
        register() {

            axios
                .get('/sanctum/csrf-cookie')
                .then(response => {

                    axios
                        .post('/api/register', this.user)
                        .then( res => {
                            localStorage.setItem('x_xsrf_token', this.getCookie(res.config.xsrfCookieName));
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
    }
}

</script>

<template>
    <section class="registration content">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="card-title">Регистрация</h2>
                <form>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" v-model="user.email" class="form-control" placeholder="example@einzelwerk.ru" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Пароль</label>
                        <input type="password" v-model="user.password" class="form-control" placeholder="************" required>
                    </div>
                    <button type="submit" @click.prevent="register" value="register" class="btn btn-primary w-100">Создать аккаунт</button>
                </form>
                <hr class="my-2">
                <span class="text-center">Уже есть аккаунт? <router-link :to="{ name: 'user.login' }">Войти</router-link></span>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
