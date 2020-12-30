const mix = require('laravel-mix');

mix.styles([
    'resources/assets/template/css/_all-skins.min.css',
    'resources/assets/template/css/AdminLTE.min.css',
    'resources/assets/template/css/bootstrap.min.css',
    'resources/assets/template/css/font-awesome.min.css',
    'resources/assets/template/css/ionicons.min.css',
    'resources/assets/template/css/dataTables.bootstrap.min.css',
    'resources/assets/template/css/badges.css',
    'resources/assets/template/css/jquery.dataTables.min.css',
    'resources/assets/template/css/responsive.dataTables.min.css',
    'resources/assets/template/js/bootstrap-datepicker.min.css'
], 'public/css/template.css')
.scripts([
    //'resources/assets/template/js/jquery.min.js',
    'resources/assets/template/js/jquery-3.3.1.js',
    'resources/assets/template/js/jquery-ui.min.js',
    'resources/assets/template/js/bootstrap.min.js',
    'resources/assets/template/js/raphael.min.js',
    'resources/assets/template/js/morris.min.js',
    'resources/assets/template/js/jquery.slimscroll.min.js',
    'resources/assets/template/js/adminlte.min.js',
    'resources/assets/template/js/demo.js',
    'resources/assets/template/js/jquery.dataTables.min.js',
    'resources/assets/template/js/dataTables.responsive.js',
    'resources/assets/template/js/sweetalert2.all.js',
    'resources/assets/template/js/bootstrap-datepicker.min.js'
], 'public/js/template.js')
.js([
    'resources/assets/js/app.js'
], 'public/js/app.js');
