const mix = require('laravel-mix');



/*****************************************************

                 DASHBOARD WEBPACK

*****************************************************/


mix.styles([
    'public/css/page/dashboard/nav.css',
    'public/css/plugin/animate.min.css',
    'public/css/plugin/bootstrap.min.css',
    'public/css/plugin/themify/themify.css',
    'public/css/plugin/tooltipster.bundle.min.css',
    'public/css/plugin/fontawesome/fontawesome.css',
    'public/css/page/dashboard/main.css',
    'public/css/page/dashboard/responsive.css',
], 'public/css/prod/dashboard/main.css');


mix.scripts([   
    'public/js/plugin/wow.min.js',
    'public/js/page/dashboard/nav.js',
    'public/js/page/dashboard/main.js',
], 'public/js/prod/dashboard/main.js')




/*****************************************************

                 WEB WEBPACK

*****************************************************/





/*****************************************************

                 PWA WEBPACK

*****************************************************/






/*****************************************************

                 COMPONENT WEBPACK

*****************************************************/

mix.styles(
    [
        "public/css/page/component/modal.css",
        "public/css/plugin/flatpickr.min.css",
        "public/css/page/component/table.css"
    ],
    "public/css/prod/component/table.css"
);

mix.scripts(
    [
        "public/js/page/component/table.js",
        "public/js/plugin/flatpickr.min.js",
    ],
    "public/js/prod/component/table.js"
);

mix.styles(
    [
        "public/css/plugin/animate.min.css",
        "public/css/plugin/bootstrap.min.css",
        'public/css/plugin/themify/themify.css',
        "public/css/plugin/tooltipster.bundle.min.css",
        "public/css/plugin/fontawesome/fontawesome.css"
    ],
    "public/css/prod/component/index_preload.css"
);


mix.scripts(
    [
        "public/js/plugin/jquery.min.js",
        "public/js/plugin/popper.min.js",
        "public/js/plugin/bootstrap.min.js",
        "public/js/plugin/sweetalert.min.js",
        "public/js/plugin/loadash.min.js",
        "public/js/plugin/tooltipster.bundle.min.js",
        "public/js/plugin/jquery.lazy.min.js"
    ],
    "public/js/prod/component/index_preload.js"
);
