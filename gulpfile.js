var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
    mix.sass('app.scss')

        .less('admin.less')

        .styles([
            './node_modules/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.css',
            './node_modules/admin-lte/plugins/datatables/dataTables.bootstrap.css',
            './node_modules/admin-lte/plugins/datatables/jquery.dataTables.css',
            './node_modules/admin-lte/plugins/iCheck/all.css'
        ], 'public/css/plugins.css')

        .copy('./node_modules/bootstrap-sass/assets/fonts/bootstrap', 'public/fonts/bootstrap')
        .copy('./node_modules/font-awesome/fonts', 'public/fonts/font-awesome')
        .copy('./node_modules/admin-lte/dist/img', 'public/images/admin-lte')
        .copy('./node_modules/admin-lte/plugins/datatables/images', 'public/images/dataTables')

        .scripts([
            './node_modules/jquery/dist/jquery.js',
            './node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
            './node_modules/admin-lte/dist/js/app.js',
            './node_modules/admin-lte/plugins/datatables/jquery.dataTables.js',
            './node_modules/admin-lte/plugins/datatables/dataTables.bootstrap.js',
            './node_modules/admin-lte/plugins/fastclick/fastclick.js',
            './node_modules/admin-lte/plugins/sparkline/jquery.sparkline.js',
            './node_modules/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
            './node_modules/admin-lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
            './node_modules/admin-lte/plugins/slimScroll/jquery.slimscroll.js',
            './node_modules/admin-lte/plugins/chartjs/Chart.js',
            './node_modules/admin-lte/plugins/iCheck/icheck.js',
            'optimus.js'
        ], 'public/js/app.js')

        .scripts([
            'custom.js'
        ], 'public/js/custom.js')

        .version([
            'css/app.css',
            'css/admin.css',
            'css/plugins.css',
            'js/app.js',
            'js/custom.js'
        ]);
});
