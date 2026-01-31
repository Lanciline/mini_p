import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue'
import { createInertiaApp, Link, Head } from '@inertiajs/inertia-vue3'

// Use import.meta.glob to let Vite statically analyze available page components
const pages = import.meta.glob('./Pages/**/*.vue');

createInertiaApp({
	resolve: name => {
		const path = `./Pages/${name}.vue`;
		const importer = pages[path];
		if (!importer) {
			return Promise.reject(new Error(`Unknown page component: ${path}`));
		}
		return importer().then(module => module.default || module);
	},
	setup({ el, App, props, plugin }) {
		const app = createApp({ render: () => h(App, props) });
		app.use(plugin);

		// Register Inertia components and aliases used by older templates
		app.component('Link', Link);
		app.component('inertia-link', Link);
		app.component('Head', Head);
		app.component('inertia-head', Head);
		app.mount(el);
	},
});
