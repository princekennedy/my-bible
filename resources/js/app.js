require('./bootstrap');
require('alpinejs');

import { App, plugin } from '@inertiajs/inertia-vue';
import Vue from 'vue';
import { InertiaProgress } from '@inertiajs/progress';

InertiaProgress.init();
Vue.use(plugin);

const el = document.getElementById('app');

new Vue({
	render: (h) =>
		h(App, {
			props: {
				initialPage: JSON.parse(el.dataset.page),
				// resolveComponent: name => require(`./Pages/${name}`).default,
				resolveComponent: (name) => import(`./Pages/${name}`).then((module) => module.default)
			}
		})
}).$mount(el);
