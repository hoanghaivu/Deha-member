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

mix.sass('resources/sass/custom/custom.scss' , 'public/dist/css/custom.min.css')
	.js('public/js/main.js', 'public/dist/js/main.min')
	.js('resources/js/custom/*', 'public/dist/js/custom.min');

mix.styles([
	'public/css/theme.css',
], 'public/dist/css/theme.min.css');
