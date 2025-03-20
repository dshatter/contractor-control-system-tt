import { createWebHistory, createRouter } from 'vue-router';


const routes = [
    {
        path: '/get',
        name: 'get.index',
        component: () => import('./components/Get.vue'),
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


export default createRouter({
    history: createWebHistory(),
    routes,
});
