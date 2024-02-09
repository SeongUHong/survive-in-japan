const mix = require('laravel-mix');

// JS
mix.js('resources/js/pages/admin_write.js', 'public/js/pages')
   .version();

// SCSS
mix.sass('resources/sass/pages/main.scss', 'public/css/pages').options({
   processCssUrls: false, // CSS내의 URL을 변경하지 않음
});
