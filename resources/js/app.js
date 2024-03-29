import "./bootstrap"
import Vue from "vue"
import { InertiaApp } from "@inertiajs/inertia-vue"
import VueMeta from 'vue-meta';

Vue.use(InertiaApp)

Vue.mixin({ methods: { route: window.route } });

Vue.use(VueMeta);

Vue.prototype.trans = (key) => {
    return _.get(window.trans, key, key);
};

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

const app = document.getElementById('app')

new Vue({
    metaInfo: {
        titleTemplate: (title) => title ? `${title} - ${process.env.MIX_APP_NAME}` : process.env.MIX_APP_NAME
    },
    render: h => h(InertiaApp, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: name => require(`./Pages/${name}`).default,
        },
    }),
}).$mount(app)
