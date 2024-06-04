import './bootstrap';
import '../css/app.css';
import '../../node_modules/gumshoejs/dist/gumshoe.polyfills'

import { createApp, h } from 'vue';
import { createInertiaApp, Link, Head } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { createPinia } from 'pinia';
import { initFlowbite } from 'flowbite';
import { i18nVue } from 'laravel-vue-i18n';
import VueApexCharts from 'vue3-apexcharts';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
const pinia = createPinia();

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    // resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    resolve: (name) => {
        const page = resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue')
        );
        page.then((module) => {
            if (module.default.layout === undefined) {
                module.default.layout = DefaultLayout;
            }
        });
        return page;
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(pinia)
            .use(initFlowbite)
            .use(VueApexCharts)
            .component("apexchart", VueApexCharts)
            .use(i18nVue, {
                resolve: async (lang) => {
                    try {
                        const langs = import.meta.glob("../../lang/*.json");
                        let currentLang = lang.includes("php_")
                            ? lang.toString()
                            : `php_${lang.toString()}`;
                        return await langs[`../../lang/${currentLang}.json`]();
                    } catch (e) {
                        console.error(e);
                    }
                },
            })
            .component("Link", Link)
            .component("Head", Head)
            .mount(el);
    },
    progress: {
        color: '#2299dd',
    },
});
