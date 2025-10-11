import './bootstrap';
import '../css/app.css';
import './index.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createPinia } from 'pinia';
import { useAuthStore } from '@/stores/auth';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const pinia = createPinia();
        
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(pinia);
            
        // Initialize auth store but don't redirect
        const authStore = useAuthStore(pinia);
        if (authStore.token) {
            authStore.checkAuth();
        }
        
        return app.mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});