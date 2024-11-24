import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue"; // nếu bạn sử dụng Vue
import path from "path";

export default defineConfig({
    plugins: [vue()], // hoặc các plugin bạn sử dụng
    resolve: {
        alias: {
            "@css": path.resolve(__dirname, "resources/css"),
            "@js": path.resolve(__dirname, "resources/js"),
            "@images": path.resolve(__dirname, "resources/images"),
            "@font":path.resolve(__dirname,"ressources/fonts"),
        },
    },
    server: {
        proxy: {
            "/api": "http://127.0.0.1:8000", // Proxy tất cả các yêu cầu tới '/api' sang Laravel server
            // Hoặc cấu hình proxy khác nếu cần thiết
        },
    },
});
