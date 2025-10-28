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
        host: '127.0.0.1',
        port: 3000,
        strictPort: true,
        hmr: {
            host: 'localhost',
        },
    },
    build: {
        sourcemap: false,
    },
});
