import { createRouter, createWebHistory } from "vue-router";
import MainePage from "../Pages/MainePage.vue";
import CreateMoviePage from '../Pages/Movie/CreateMoviePage.vue';
import CreteGenrePage from '../Pages/Genre/CreteGenrePage.vue';
import InfoMoviePage from '../Pages/Movie/InfoMoviePage.vue';
import EditMoviePage from '../Pages/Movie/EditMoviePage.vue';
import GenresPage from '../Pages/Genre/GenresPage.vue';
import InfoGenrePage from '../Pages/Genre/InfoGenrePage.vue';



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
    },
    {
        path: '/infoMovie/:id',
        component: InfoMoviePage
    },
    {
        path: '/editMovie/:id',
        component: EditMoviePage
    },
    {
        path: '/genres',
        component: GenresPage
    },
    {
        path: '/infoGenre/:id',
        component: InfoGenrePage
    },

];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;