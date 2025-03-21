<script>
export default {
    name: "Registration",
}

</script>

<template>
    <section class="content">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="card-title">Регистрация</h2>
                <form>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="example@einzelwerk.ru" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Пароль</label>
                        <input type="password" class="form-control" id="password" placeholder="************" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Создать аккаунт</button>
                </form>
                <hr class="my-2">
                <span class="text-center">Уже есть аккаунт? <router-link :to="{ name: 'user.login' }">Войти</router-link></span>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
