import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from "@vitejs/plugin-react";

export default defineConfig({
    plugins: [
        react(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.jsx',
                "resources/js/show.jsx",
                "resources/js/deal.jsx",
                "resources/scss/app.scss"
            ],
            refresh: true,
        }),
    ],
    server: {
	    host: true,
	    hmr: {
		    host: 'localhost',
	    },
    },
});
