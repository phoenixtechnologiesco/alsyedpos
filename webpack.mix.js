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

//mix.js('resources/js/app.js', 'public/js')
//mix.sass('resources/sass/app.scss', 'public/css');

//**************** CSS ******************** 
//css
//mix.copy('resources/vendors/pace-progress/css/pace.min.css', 'public/css');
mix.copy('node_modules/@coreui/chartjs/dist/css/coreui-chartjs.css', 'public/css');
mix.copy('node_modules/cropperjs/dist/cropper.css', 'public/css');

// mix.copy('node_modules/bootstrap/dist/css/bootstrap.css', 'public/css');
// OR
// mix.copy('node_modules/@coreui/coreui-pro/dist/css/bootstrap.css', 'public/css');

mix.copy('node_modules/@coreui/coreui-datatables/css/dataTables.bootstrap4.css', 'public/css');

// mix.copy('node_modules/@coreui/coreui-pro/dist/css/themes/coreui-dark.css', 'public/css');
//main css
mix.sass('resources/sass/style.scss', 'public/css');

//************** SCRIPTS ****************** 
// general scripts
mix.copy('node_modules/@coreui/utils/dist/coreui-utils.js', 'public/js');
// mix.copy('node_modules/@coreui/coreui-pro/dist/js/coreui.js', 'public/js');
mix.copy('node_modules/@coreui/coreui-pro/dist/js/coreui.js', 'public/js'); 
// views scripts
// mix.copy('node_modules/jquery/dist/jquery.js', 'public/js');
// mix.copy('node_modules/bootstrap/dist/js/bootstrap.js', 'public/js');
// mix.copy('node_modules/axios/dist/axios.js', 'public/js'); 
// mix.copy('node_modules/pace-progress/pace.js', 'public/js');  
mix.copy('node_modules/chart.js/dist/Chart.js', 'public/js'); 
mix.copy('node_modules/@coreui/chartjs/dist/js/coreui-chartjs.bundle.js', 'public/js');
mix.copy('node_modules/cropperjs/dist/cropper.js', 'public/js');
// mix.copy('node_modules/perfect-scrollbar/dist/perfect-scrollbar.js', 'public/js');
mix.copy('node_modules/@coreui/coreui-datatables/js/dataTables.coreui.js', 'public/js');
// details scripts
// mix.copy('resources/js/coreui/advanced-forms.js', 'public/js');
// mix.copy('resources/js/coreui/ajax-load.js', 'public/js');
// mix.copy('resources/js/coreui/alert.js', 'public/js');
// mix.copy('resources/js/coreui/aside-menu.js', 'public/js');
// mix.copy('resources/js/coreui/async-load.js', 'public/js');
// mix.copy('resources/js/coreui/button.js', 'public/js');
// mix.copy('resources/js/coreui/calender.js', 'public/js');
// mix.copy('resources/js/coreui/carousel.js', 'public/js');
// mix.copy('resources/js/coreui/charts.js', 'public/js');
// mix.copy('resources/js/coreui/class-toggler.js', 'public/js');
// mix.copy('resources/js/coreui/code-editor.js', 'public/js');
// mix.copy('resources/js/coreui/collapse.js', 'public/js');
// mix.copy('resources/js/coreui/colors.js', 'public/js');
// mix.copy('resources/js/coreui/datatables.js', 'public/js');
// mix.copy('resources/js/coreui/draggable-cards.js', 'public/js');
// mix.copy('resources/js/coreui/dropdown.js', 'public/js');
// mix.copy('resources/js/coreui/forms.js', 'public/js');
// mix.copy('resources/js/coreui/google-maps.js', 'public/js');
// mix.copy('resources/js/coreui/index.js', 'public/js');
// mix.copy('resources/js/coreui/loading-button.js', 'public/js');
// mix.copy('resources/js/coreui/loading-buttons.js', 'public/js');
// mix.copy('resources/js/coreui/main.js', 'public/js');
// mix.copy('resources/js/coreui/markdown-editor.js', 'public/js');
// mix.copy('resources/js/coreui/modal.js', 'public/js');
// mix.copy('resources/js/coreui/multi-select.js', 'public/js');
// mix.copy('resources/js/coreui/notifications.js', 'public/js');
// mix.copy('resources/js/coreui/polyfills.js', 'public/js');
// mix.copy('resources/js/coreui/popover.js', 'public/js');
// mix.copy('resources/js/coreui/popovers.js', 'public/js');
// mix.copy('resources/js/coreui/scrollspy.js', 'public/js');
// mix.copy('resources/js/coreui/sidebar.js', 'public/js');
// mix.copy('resources/js/coreui/tab.js', 'public/js');
// mix.copy('resources/js/coreui/tables.js', 'public/js');
// mix.copy('resources/js/coreui/text-editor.js', 'public/js');
// mix.copy('resources/js/coreui/text-editors.js', 'public/js');
// mix.copy('resources/js/coreui/toast.js', 'public/js');
// mix.copy('resources/js/coreui/toastr.js', 'public/js');
// mix.copy('resources/js/coreui/toggle-classes.js', 'public/js');
// mix.copy('resources/js/coreui/tooltip.js', 'public/js');
// mix.copy('resources/js/coreui/tooltips.js', 'public/js');
// mix.copy('resources/js/coreui/validation.js', 'public/js');
// mix.copy('resources/js/coreui/widgets.js', 'public/js');
// details scripts admin-panel
mix.js('resources/js/coreui/menu-create.js', 'public/js');
mix.js('resources/js/coreui/menu-edit.js', 'public/js');
mix.js('resources/js/coreui/media.js', 'public/js');
mix.js('resources/js/coreui/media-cropp.js', 'public/js');
//*************** OTHER ****************** 
//fonts
mix.copy('node_modules/@coreui/icons/fonts', 'public/fonts');
//icons
mix.copy('node_modules/@coreui/icons/css/free.min.css', 'public/css');
mix.copy('node_modules/@coreui/icons/css/brand.min.css', 'public/css');
mix.copy('node_modules/@coreui/icons/css/flag.min.css', 'public/css');
mix.copy('node_modules/@coreui/icons/svg/flag', 'public/svg/flag');

mix.copy('node_modules/@coreui/icons/sprites/', 'public/icons/sprites');
//images
mix.copy('resources/assets', 'public/assets');
