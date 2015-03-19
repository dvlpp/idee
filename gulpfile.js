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
            '../bower/jquery/dist/jquery.js',
            'imagelightbox.js'
            //'../assets/bower/bootstrap/dist/js/bootstrap.js'
        ], 'public/js/vendor.js', 'resources/assets/js')

        .scripts([
            'bloc.js',
            'main.js'
        ], 'public/js/idee.js', 'resources/assets/js')

        .version(["public/css/app.css", "public/js/idee.js"]);

});
