const mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');

require('laravel-mix-tailwind');
require('laravel-mix-purgecss');

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

mix.sass('resources/scss/app.scss', 'public/css')
    .options({
        postCss: [tailwindcss('tailwind.js')],
        processCssUrls: false,
    })
    .js('resources/js/app.js', 'public/js');
