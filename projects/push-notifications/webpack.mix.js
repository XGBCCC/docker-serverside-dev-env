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

const jsScripts = [
    'resources/js/app.js'
];

const cssScripts = [
    'public/css/app.css',
    'public/css/colors.css'
];

mix.js(jsScripts, 'public/js/vendor.js')
    .sass('resources/sass/app.scss', 'public/css/app.css')
    .sass('resources/sass/colors.scss', 'public/css/colors.css')
    .styles(cssScripts, 'public/css/vendor.css');

if (mix.inProduction()) {
    mix.version();
}
