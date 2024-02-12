const mix = require('laravel-mix');

// JS
mix.js('resources/js/pages/admin/write.js', 'public/js/pages/admin')
   .version();
mix.js('resources/js/pages/*.js', 'public/js/pages/app.js')
   .version();

// SCSS
mix.sass('resources/sass/pages/main.scss', 'public/css/pages').options({
   processCssUrls: false, // CSS내의 URL을 변경하지 않음
});
mix.sass('resources/sass/pages/post.scss', 'public/css/pages').options({
   processCssUrls: false,
});
