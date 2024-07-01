// vite.config.js
import {resolve} from "path"
import { build } from "vite"
import { defineConfig } from 'vite';
import usePHP from 'vite-plugin-php';
// add the beginning of your app entry
import 'vite/modulepreload-polyfill'

export default defineConfig({
 plugins: [usePHP({
	binary: '/opt/lampp/bin/php-8.1.10',
	entry: [
		'registration.php',
		'about.php',
		'contact.php',
		'pages/**/*.php',
		'partials/*.php',
	],
})],
 build:{
    main: resolve(__dirname, 'index.html'),
    garantii: resolve(__dirname, 'index.html'),
    kakzakaz: resolve(__dirname, 'index.html'),
    katalog: resolve(__dirname, 'index.html'),
    kontakti: resolve(__dirname, 'index.html'),
    lichkab: resolve(__dirname, 'index.html'),
    manifest: true,
    rollupOptions: {
      // overwrite default .html entry
      input: '/path/to/main.js',
    },
  },
});

