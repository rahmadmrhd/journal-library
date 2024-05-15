import { defineConfig } from "vite";
import { globSync } from "glob";
import laravel from "laravel-vite-plugin";

export default defineConfig({
  plugins: [
    laravel({
      input: [
        ...globSync('resources/css/**/*.css'),
        ...globSync('resources/js/**/*.js', {
          ignore: "resources/js/bootstrap.js",
        }),
      ],
      refresh: true,
    }),
  ],
  build: {
    watch: {
      include: ["resources/**"],
    },
  },
});
