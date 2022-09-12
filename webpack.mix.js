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

// mix.js('resources/js/app.js', 'public/js').vue()
//     .sass('resources/sass/app.scss', 'public/css'
//     );



// mix.js('resources/js/app.js','public/js').vue()
//     .sass('resources/sass/app.scss','public/css');
//     // .webpackConfig(require('./webpack.config'));



// mix.js('resources/js/app.js', 'public/js').vue()
//     .sass('resources/sass/app.scss', 'public/css').js('node_modules/popper.js/dist/popper.js', 'public/js').sourceMaps();

// mix.disableSuccessNotifications();

mix 
    .js('resources/js/app.js','public/js').vue()
    .sass('resources/sass/app.scss','public/css')
    .webpackConfig(require('./webpack.config'));

mix.version();
mix.disableSuccessNotifications();