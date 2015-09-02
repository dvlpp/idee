var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    mix.less('app.less')

        .scripts([
            'bower/jquery/dist/jquery.js',
            'bower/swiper/dist/js/swiper.jquery.js',
            'js/imagelightbox.js'
        ], 'public/js/vendor.js', 'resources/assets')

        .scripts([
            'bloc.js',
            'main.js'
        ], 'public/js/idee.js', 'resources/assets/js')

        .copy('resources/assets/bower/swiper/dist/css/swiper.min.css', 'public/css/swiper.css')

        .version(["public/css/app.css", "public/js/idee.js"]);

});
