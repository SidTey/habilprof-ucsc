import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.jsx'],
            refresh: true,
        }),
    ],
    esbuild: {
        jsxFactory: 'React.createElement',
        jsxFragment: 'React.Fragment',
        jsxInject: `import React from 'react'`,
    },
    server: {
        host: true, // Escucha en todas las interfaces de red
        port: 5173,
        strictPort: true,
        hmr: {
            host: 'localhost',
        },
    },
    build: {
        sourcemap: false,
    },
});
