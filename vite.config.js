import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { globSync } from 'glob';

export default defineConfig({
  plugins: [
    laravel({
      input: [...globSync('resources/css/*.css'), ...globSync('resources/js/*.js', {
        ignore: "resources/js/bootstrap.js",
      })],
      refresh: true,
    }),
  ],
  build: {
    watch: {
      include: ["resources/**"],
    },
  }
});
