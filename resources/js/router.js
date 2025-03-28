import { createWebHistory, createRouter } from 'vue-router';

const routes = [
    {
        path: '/',
        name: 'user.index',
        component: () => import('./components/Index.vue'),
    },
    {
        path: '/login',
        name: 'user.login',
        component: () => import('./components/Login.vue'),
    },
    {
        path: '/register',
        name: 'user.register',
        component: () => import('./components/Registration.vue'),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('x_xsrf_token');

    if (!token) {
        return (to.name === 'user.login' || to.name === 'user.register') ? next() : next({ name: 'user.login' });
    } else {
        if (to.name === 'user.login' || to.name === 'user.register') {
            return next({ name: 'user.index' });
        }
    }

    return next();

});

export default router;
