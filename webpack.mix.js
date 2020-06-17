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

// html5shiv
mix.copy('node_modules/html5shiv/dist', 'public/assets/vendor/html5shiv', false);

// respond.js
mix.copy('node_modules/respond.js/dest', 'public/assets/vendor/respond', false);

// gentelella
mix.copy('node_modules/gentelella/vendors', 'public/assets/vendor/gentelella/vendors', false);
mix.copy('node_modules/font-awesome', 'public/assets/vendor/font-awesome', false);

//font-awesome
mix.copy('node_modules/gentelella/build', 'public/assets/vendor/gentelella', false);

// jquery form
mix.copy('node_modules/jquery-form/dist', 'public/assets/vendor/jquery-form', false);

// jquery validations
mix.copy('node_modules/jquery-validation/dist', 'public/assets/vendor/jquery-validation', false);

// json editor
mix.copy('node_modules/jsoneditor/dist', 'public/assets/vendor/jsoneditor', false);

// timepicker
mix.copy('node_modules/timepicker', 'public/assets/vendor/timepicker', false);

// bootbox
mix.copy('node_modules/bootbox', 'public/assets/vendor/bootbox', false);

// fullcalendar
mix.copy('node_modules/fullcalendar', 'public/assets/vendor/fullcalendar', false);

// select2
mix.copy('node_modules/select2', 'public/assets/vendor/select2', false);

// bootstrap-colorpicker
mix.copy('node_modules/bootstrap-colorpicker', 'public/assets/vendor/bootstrap-colorpicker', false);

// images
mix.copy('resources/assets/images', 'public/assets/images', false);

// app styles
mix.sass('resources/assets/sass/app.scss', 'public/assets/css');
mix.sass('resources/assets/sass/login.scss', 'public/assets/css');
mix.sass('resources/assets/sass/theme.scss', 'public/assets/css');

// app scripts
mix.js('resources/assets/js/app.js', 'public/assets/js');
mix.combine([
    'resources/assets/js/gentelella.js',
    'resources/assets/js/datatables.js',
    'resources/assets/js/main.js',
    'resources/assets/js/utils.js'
], 'public/assets/js/main.js');
