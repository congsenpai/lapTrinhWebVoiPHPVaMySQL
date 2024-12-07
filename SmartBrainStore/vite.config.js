import { defineConfig } from "vite";
import path from "path";
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
              'resources/css/app.css',
              'resources/js/app.js',
            ],
            refresh: true,
          }),
    ], // hoặc các plugin bạn sử dụng
    resolve: {
        alias: {
            "@css": path.resolve(__dirname, "resources/css"),
            "@js": path.resolve(__dirname, "resources/js"),
            "@images": path.resolve(__dirname, "resources/images"),
            "@font":path.resolve(__dirname,"resources/fonts"),
        },
    },
    server: {
        proxy: {
            "/api": "http://127.0.0.1:8000", // Proxy tất cả các yêu cầu tới '/api' sang Laravel server
            // Hoặc cấu hình proxy khác nếu cần thiết
        },
    },
});

 