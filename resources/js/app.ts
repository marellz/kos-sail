import "../styles/app.scss";

import { createApp, h, DefineComponent } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import { components } from "./modules/components";
import DefaultLayout from "./layouts/default.vue";
const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const pages = import.meta.glob<DefineComponent>("./pages/**/*.vue", {
                eager: true,
            }),
            page = pages[`./pages/${name}.vue`];

        if (!page.default?.layout) {
            page.default.layout = DefaultLayout;
        }

        return page;
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue);

        Object.entries(components).forEach(([name, component]) => {
            app.component(name, component);
        });

        app.mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
