import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import fs from 'fs';
import {config as loadEnv } from 'dotenv';
loadEnv();

const useHttps = process.env.VITE_HTTPS === 'true';
const httpsConfig = useHttps ? {
    key: fs.readFileSync(process.env.VITE_SERVER_PRIVKEY),
    cert: fs.readFileSync(process.env.VITE_SERVER_FULLCHAIN),
} : undefined;

export default defineConfig({
    server: {
        host: process.env.VITE_SERVER_HOST || 'localhost',
        port: 5173,
        https: httpsConfig,
    },
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
