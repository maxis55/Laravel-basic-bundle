const mix = require('laravel-mix');

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

mix.js('resources/admin/js/app.js', 'public/admin/js')
    .css('resources/admin/css/app.css', 'public/admin/css')
    .copyDirectory('resources/admin/js/ckeditor', 'public/admin/js/ckeditor');
