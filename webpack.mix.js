const mix = require('laravel-mix');

const webpackConfig = require('./webpack.config');

/*
    Backend Mix
*/
mix.scripts([
    'public/assets/js/jquery-3.3.1.min.js',
    'public/assets/js/popper.min.js',
    'public/assets/js/bootstrap.min.js',
    'public/assets/js/moment.min.js',
    'public/assets/js/sweetalert.min.js',
    'public/assets/js/delete.handler.js',
    'public/assets/plugins/js-cookie/js.cookie.js',
    'public/vendor/jsvalidation/js/jsvalidation.js',
    'public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js',
    'public/assets/plugins/croppie/croppie.js'
], 'public/assets/js/vendor.js');
mix.styles([
    'public/assets/css/fontawesome-all.min.css',
    'public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css',
    'public/assets/plugins/croppie/croppie.css',
], 'public/assets/css/vendor.css');
mix.sass('resources/sass/app.scss', 'public/assets/css');
mix.minify(['public/assets/js/vendor.js', 'public/assets/css/vendor.css']);


/*
    Frontend Mix
*/
mix.sass('resources/style/app.scss',
    'public/frontend/css/app.css',
);
mix.js([
    'resources/js/bootstrap.js',
    'resources/js/app.js',
], 'public/frontend/js/app.js')
    .vue()
    .webpackConfig(webpackConfig)
    .sourceMaps();
mix.minify(['public/frontend/js/app.js', 'public/frontend/css/app.css']);


/*
    Config Mix
*/
mix.browserSync({
    proxy: "http://127.0.0.1:8000"
});

mix.webpackConfig({
    stats: {
        children: true,
    },
});
if (mix.inProduction() || true) {
    mix.version();
}


