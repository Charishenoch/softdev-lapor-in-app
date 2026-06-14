import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/auth.js','resources/js/dashboard.js', 'resources/js/lapor.js', 'resources/js/riwayat.js', 'resources/js/dashboard-admin.js', 'resources/js/pemantauan.js'],
            refresh: true,
        }),
    ],
});
