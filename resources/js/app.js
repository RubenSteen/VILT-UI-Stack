/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/*
|----------------------------------------------------------------
| Vue 2 (Inertia) https://inertiajs.com/client-side-setup
|----------------------------------------------------------------
*/
import { App, plugin } from '@inertiajs/inertia-vue';
import Vue from 'vue';

Vue.use(plugin);

const el = document.getElementById('app');

new Vue({
    render: (h) =>
        h(App, {
            props: {
                initialPage: JSON.parse(el.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(el);
// ---End---

/*
|----------------------------------------------------------------
| Vue 2 (Inertia) https://inertiajs.com/progress-indicators
|----------------------------------------------------------------
*/
import { InertiaProgress } from '@inertiajs/progress';
InertiaProgress.init();
// ---End---

/*
|----------------------------------------------------------------
| Ziggy routing https://inertiajs.com/routing / https://github.com/tighten/ziggy
|----------------------------------------------------------------
*/
Vue.prototype.$route = (...args) => route(...args).url();
// ---End---
