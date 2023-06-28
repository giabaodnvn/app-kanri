const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);

    mix.copyDirectory('resources/assets/img', 'public/static/img');
    mix.copyDirectory('resources/assets/img/user', 'public/static/img/user');
    mix.copyDirectory('resources/assets/webfonts', 'public/static/css/webfonts');

    mix.copyDirectory('resources/assets/js/user', 'public/static/js/user');
    mix.copyDirectory('resources/assets/css/user', 'public/static/css/user');

    mix.js('resources/assets/js/adminlte.js', 'public/static/js')
    mix.js('resources/assets/js/bootstrap.bundle.js', 'public/static/js')
    mix.js('resources/assets/js/jquery.js', 'public/static/js');

    mix.sass('resources/assets/sass/_variables.scss', 'public/static/css/user');
    mix.sass('resources/assets/sass/user-custom.scss', 'public/static/css/user');

    mix.styles('resources/assets/css/adminlte.css', 'public/static/css/adminlte.css')
    mix.styles('resources/assets/css/lib/all.min.css', 'public/static/css/lib/all.min.css')
    mix.styles('resources/assets/css/lib/icheck-bootstrap.css', 'public/static/css/lib/icheck-bootstrap.css');


