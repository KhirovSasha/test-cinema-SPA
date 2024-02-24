import './bootstrap';
import { createApp } from 'vue';
import AppComponent from './App.vue';
import router from './router/index.js';

const app = createApp({
    components: {
        AppComponent
    }
});


app.use(router);
app.mount('#app');