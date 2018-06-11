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

mix.scripts([ 
    'resources/assets/js/jquery.js',
    'resources/assets/js/popper.min.js',
    'resources/assets/js/bootstrap.js',
    'resources/assets/js/vue.js',
    'resources/assets/js/axios.js',
    'resources/assets/js/app.js',
    'resources/assets/js/admin.js',
    'resources/assets/js/select.min.js',
    ], 'public/js/app.js')
    .styles([
    'resources/assets/css/bootstrap.css', 
    'resources/assets/css/admin.css',
    'resources/assets/css/materialdesignicons.min.css',
    'resources/assets/css/select.min.css',
    ],'public/css/app.css');