import { createSSRApp, h } from 'vue';
import { renderToString } from '@vue/server-renderer';
import { createInertiaApp, Link, Head } from '@inertiajs/vue3';
import createServer from '@inertiajs/vue3/server';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { createPinia } from 'pinia';
// import { initFlowbite } from 'flowbite';
import { i18nVue } from 'laravel-vue-i18n';
// import VueApexCharts from 'vue3-apexcharts';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
const pinia = createPinia();

createServer((page) =>
    createInertiaApp({
        page,
        render: renderToString,
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
        setup({ App, props, plugin }) {
            return createSSRApp({ render: () => h(App, props) })
                .use(plugin)
                .use(pinia)
                //.use(initFlowbite)
                // .use(i18nVue, {
                //     lang: 'id',
                //     resolve: lang => {
                //         const langs = import.meta.glob('../../lang/*.json', { eager: true });
                //         return langs[`../../lang/${lang}.json`].default;
                //     },
                // })
                .use(i18nVue, {
                    lang: 'id',
                    resolve: (lang) => {
                        try {
                            const langs = import.meta.glob(
                                "../../lang/*.json",
                                {
                                    eager: true,
                                },
                            );
                            let currentLang = lang.includes("php_")
                                ? lang.toString()
                                : `php_${lang.toString()}`;
                            return langs[`../../lang/${currentLang}.json`].default;
                        } catch (e) {
                            console.log(e);
                        }
                    },
                })
                // .use(VueApexCharts)
                // .component("apexchart", VueApexCharts)
                .component("Link", Link)
                .component("Head", Head)
                .use(ZiggyVue, {
                    ...page.props.ziggy,
                    location: new URL(page.props.ziggy.location),
                });
        },
        progress: {
            color: '#2299dd',
        },
    })
);
