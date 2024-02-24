import { createRouter, createWebHistory } from "vue-router";
import MainePage from "../Pages/MainePage.vue";
import CreateMoviePage from '../Pages/Movie/CreateMoviePage.vue';
import CreteGenrePage from '../Pages/Genre/CreteGenrePage.vue';


const routes = [
    {
        path: '/',
        component: MainePage
    },
    {
        path: '/createMovie',
        component: CreateMoviePage
    },
    {
        path: '/createGenre',
        component: CreteGenrePage
    }

];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;