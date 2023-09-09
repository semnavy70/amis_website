import("./bootstrap.js");
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { InertiaProgress } from "@inertiajs/progress";
import ImageHelper from "./Helpers/image_helper";
import DateHelper from "./Helpers/date_helper";
import AppHelper from "./Helpers/app_helper";
import {VueMasonryPlugin} from "vue-masonry";
import inertiaTitle from 'inertia-title/vue3';
import VueSocialSharing from 'vue-social-sharing'

createInertiaApp({
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(VueMasonryPlugin)
            .use(inertiaTitle)
            .use(VueSocialSharing)
            .mixin(AppHelper)
            .mixin(ImageHelper)
            .mixin(DateHelper)
            .mixin(AppHelper)
            .mixin({ methods: { route } })
            .mount(el)
    },
});

InertiaProgress.init({
    delay: 0,
    color: '#4c9ac7',
    includeCSS: true,
    showSpinner: false,
});
