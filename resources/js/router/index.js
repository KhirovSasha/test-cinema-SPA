import { createRouter, createWebHistory } from "vue-router";
import MainePage from "../Pages/MainePage.vue";
import CreateMoviePage from '../Pages/Movie/CreateMoviePage.vue';

const routes = [
    {
        path: '/',
        component: MainePage
    },
    {
        path: '/createMovie',
        component: CreateMoviePage
    }

];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;