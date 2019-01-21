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


//Stylus e Css


mix.stylus('resources/assets/stylus/main.styl', 'public/css/main.min.css').options({
    processCssUrls: false
});
mix.stylus('resources/assets/stylus/home.styl', 'public/css/home.min.css').options({
    processCssUrls: false
});
mix.stylus('resources/assets/stylus/alianca.styl', 'public/css/alianca.min.css').options({
    processCssUrls: false
});
mix.stylus('resources/assets/stylus/novel.styl', 'public/css/novel.min.css').options({
    processCssUrls: false
});
mix.stylus('resources/assets/stylus/novels.styl', 'public/css/novels.min.css').options({
    processCssUrls: false
});
mix.stylus('resources/assets/stylus/contato.styl', 'public/css/contato.min.css').options({
    processCssUrls: false
});
mix.stylus('resources/assets/stylus/termosPolitica.styl', 'public/css/termosPolitica.min.css').options({
    processCssUrls: false
});
mix.stylus('resources/assets/stylus/grupo.styl', 'public/css/grupo.min.css').options({
    processCssUrls: false
});
mix.stylus('resources/assets/stylus/grupos.styl', 'public/css/grupos.min.css').options({
    processCssUrls: false
});
mix.stylus('resources/assets/stylus/auth.styl', 'public/css/auth.min.css').options({
    processCssUrls: false
});
mix.stylus('resources/assets/stylus/dashboard.styl', 'public/css/dashboard.min.css').options({
    processCssUrls: false
});
mix.stylus('resources/assets/stylus/dashboard-control.styl', 'public/css/dashboard-control.min.css').options({
    processCssUrls: false
});





//JavaScripts


mix.scripts([
    'resources/assets/js/main.js',
], 'public/js/main.min.js');

mix.js('resources/assets/js/home.js', 'public/js/home.min.js');

mix.scripts([
    'resources/assets/js/components/ratingFavorite.js',
    'resources/assets/js/novel.js'
], 'public/js/novel.min.js');

mix.scripts([
    'resources/assets/js/components/ratingFavorite.js',
    'resources/assets/js/grupo.js'
], 'public/js/grupo.min.js');


mix.scripts([
    'resources/assets/js/components/form-essential.js'
], 'public/js/novels.min.js');

mix.scripts([
    'resources/assets/js/components/form-essential.js'
], 'public/js/grupos.min.js');

mix.scripts(['resources/assets/js/components/dashboard.js'], 'public/js/dashboard.min.js');

mix.copy('node_modules/jquery/dist/jquery.js', 'public/js/jquery.js');
mix.copy('node_modules/font-awesome/css/font-awesome.min.css', 'public/css/font-awesome.min.css');
mix.copyDirectory('node_modules/font-awesome/fonts', 'public/fonts');
//mix.browserSync('localhost');
mix.version()




var SWPrecacheWebpackPlugin = require('sw-precache-webpack-plugin');

mix.webpackConfig({
    plugins: [
    new SWPrecacheWebpackPlugin({
        cacheId: 'pwa',
        filename: 'service-worker.js',
        staticFileGlobs: ['public/**/*.{css,eot,svg,ttf,woff,woff2,js,html}'],
        minify: true,
        stripPrefix: 'public/',
        handleFetch: true,
        dynamicUrlToDependencies: { //you should add the path to your blade files here so they can be cached
               //and have full support for offline first (example below)
            // '/posts': ['resources/views/posts.blade.php']
        },
        staticFileGlobsIgnorePatterns: [/\.map$/, /mix-manifest\.json$/, /manifest\.json$/, /service-worker\.js$/],
        navigateFallback: '/',
        runtimeCaching: [
            {
                urlPattern: /^https:\/\/fonts\.googleapis\.com\//,
                handler: 'cacheFirst'
            },
            {
                urlPattern: /^https:\/\/www\.thecocktaildb\.com\/images\/media\/drink\/(\w+)\.jpg/,
                handler: 'cacheFirst'
            }
        ],
        // importScripts: ['./js/push_message.js']
    })
    ]
});