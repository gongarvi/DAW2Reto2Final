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
mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/jsPuzzle.js','public/js')
    .js('resources/js/formulario.js', 'public/js')
    .js('resources/js/millonario.js', 'public/js')
    .js('resources/js/ruleta.js', 'public/js')
    .js('resources/js/mujeres.js', 'public/js')
    .js('resources/js/tresenrayas.js', 'public/js')
    .js('resources/js/tresenrayasdiablo.js', 'public/js')
    .js('resources/js/game-page.js', 'public/js')
    .js('resources/js/match.js', 'public/js')
    .js('resources/js/buscaminas.js', 'public/js')
    .css('resources/css/matching.css','public/css')
    .sourceMaps()
    .sass('resources/sass/app.scss', 'public/css')
    .css("resources/css/matching.css","public/css");
/*
mix.webpackConfig({
    output: {
        chunkFilename: 'js/chunks/[name].js',
    },
});
*/

