const mix = require('laravel-mix');


mix.sass('resources/assets/sass/app.scss', 'public/css/app.css')
    .options({
        processCssUrls: false,
    });

if(mix.inProduction()) {
    mix.version();
}