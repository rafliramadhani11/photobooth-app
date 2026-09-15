import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import react from '@vitejs/plugin-react'
import inertia from '@inertiajs/vite';
import { wayfinder } from "@laravel/vite-plugin-wayfinder";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/flux-app.css',
                'resources/js/app.js',
                'resources/js/components/charts.tsx',
            ],
            refresh: true,
        }),
        react(),
        inertia(),
        tailwindcss(),
        !process.env.VERCEL && wayfinder(),
    ].filter(Boolean),
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
