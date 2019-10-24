let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/drop_uploader.js', 'public/js')
    .js('resources/js/jquery.fileuploader.min.js', 'public/js')
    .js('resources/js/bootstrap-tagsinput.js', 'public/js')
    .js('resources/js/webslidemenu.js', 'public/js')
    .sass('resources/sass/themify.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/custom.scss', 'public/css')
    .styles('resources/sass/bootstrap-tagsinput.css', 'public/css/bootstrap-tagsinput.css')
    .styles('resources/sass/fade-down.css', 'public/css/fade-down.css')
    .styles('resources/sass/webslidemenu.css', 'public/css/webslidemenu.css')
    .styles('resources/sass/white-gry.css', 'public/css/white-gry.css')
