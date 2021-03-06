require('./bootstrap');

import Vue from 'vue';
import Vuikit from 'vuikit'
import VuikitIcons from '@vuikit/icons'
import VueSweetalert2 from 'vue-sweetalert2';
import es6Promise from "es6-promise"
import VueMeta from 'vue-meta';
import VueClipboard from 'vue-clipboard2';

import '@vuikit/theme'
import 'sweetalert2/dist/sweetalert2.min.css';
import VueHead from 'vue-head'
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';
import VAnimateCss from 'v-animate-css';
import DataTable from 'laravel-vue-datatable';
import VueKinesis from 'vue-kinesis'
import VueMobileDetection from "vue-mobile-detection";
import { App, plugin } from '@inertiajs/inertia-vue'

es6Promise.polyfill()

Vue.use(plugin)
Vue.use(VueMobileDetection);
Vue.use(VueKinesis);
Vue.use(InertiaForm);
Vue.use(PortalVue);
Vue.use(Vuikit)
Vue.use(VuikitIcons)
Vue.use(VueSweetalert2);
Vue.use(VueHead)
Vue.use(VueMeta)
Vue.use(VueClipboard)
Vue.use(VAnimateCss);
Vue.use(DataTable);
Vue.component('pagination', require('laravel-vue-pagination'));
const app = document.getElementById('app');

new Vue({
    metaInfo: {
        titleTemplate: (title) => title ? `${title} - ARSANANDHA` : 'ARSANANDHA'
    },
    render: (h) =>
        h(App, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
