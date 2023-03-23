import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';//追加
import WindiCSS from 'vite-plugin-windicss';// 追加: Tailwind CSS をインポート


export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        WindiCSS(),// 追加: Tailwind CSS を使用
    ],
});
