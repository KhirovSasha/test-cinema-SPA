import './bootstrap';
import { createApp } from 'vue';
import AppComponent from './App.vue';
import Pagination from './Components/Pagination.vue'
import router from './router/index.js';

const app = createApp({
    components: {
        AppComponent,
    }
});

app.component('pagination', Pagination)


app.use(router);
app.mount('#app');