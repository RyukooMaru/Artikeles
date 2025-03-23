import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    server: {
        host: '0.0.0.0', // Biar dengerin semua IP, bukan cuma localhost
        port: 5173,       // Bisa ganti port kalau bentrok
        strictPort: true,
        hmr: {
            protocol: 'ws',
            host: '192.168.0.184', // IP LAN PC saya sendiri
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/appes.css',
                'resources/js/appes.js',
                'resources/css/authes.css',
                'resources/js/authes.js',
                'resources/css/partses.css',
                'resources/js/partses.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
