<?php

// ========================================
// CSS Stylesheets
// ========================================
enqueue_css_backend(array(
    'name'          => 'bootstrap',
    'relative_url'  => '/vendor/bootstrap/css/bootstrap.min.css',
    'version'       => 'v4.3.1',
));
enqueue_css_backend(array(
    'name'          => 'theme',
    'relative_url'  => '/css/core.min.css',
    'version'       => 'v1.0.1'
));
enqueue_css_backend(array(
    'name'          => 'stag-material-form',
    'relative_url'  => '/vendor/stag-material-form/main.min.css',
    'version'       => 'v1.0.1',
));
enqueue_css_backend(array(
    'name'          => 'color-theme',
    'relative_url'  => '/css/themes/blue-shade.min.css',
    'version'       => 'v1.0.1',
    'priority'       => 'high'
));
enqueue_css_backend(array(
    'name'          => 'google-fonts',
    'absolute_url'  => 'https://fonts.googleapis.com/css?family=Exo:400,500,700,700i&display=swap',
    'version'       => '1.0.1',
    'priority'      => 'low'
));
enqueue_css_backend(array(
    'name'          => 'stag-icons',
    'relative_url'  => '/stagphp-icons/style.css',
    'version'       => '1.0.1',
    'priority'       => 'low'
));
enqueue_css_backend(array(
  'name'          => 'dropzone-css',
  'relative_url'  => '/vendor/dropzone/dropzone.min.css',
  'version'       => '1.0.1',
  'priority'       => 'low'
));

// ========================================
// JS Script
// ========================================
enqueue_js_backend(array(
    'name'          => 'jquery',
    'relative_url'  => '/js/components/jquery.min.js',
    'version'       => '1.0.1'
    // 'async'         => FALSE
));
enqueue_js_backend(array(
  'name'          => 'popper-js',
  'relative_url'  => '/vendor/bootstrap/js/popper.min.js',
  'version'       => '1.0.1'
));
enqueue_js_backend(array(
    'name'          => 'bootstrap',
    'relative_url'  => '/vendor/bootstrap/js/bootstrap.min.js',
    'version'       => '1.0.1'
));
enqueue_js_backend(array(
    'name'          => 'hammer',
    'relative_url'  => '/js/components/hammer.min.js',
    'version'       => '1.0.1'
));
enqueue_js_backend(array(
    'name'          => 'smooth-scrollbar',
    'relative_url'  => '/js/components/smooth-scrollbar.js',
    'version'       => '1.0.1'
));
enqueue_js_backend(array(
    'name'          => 'dragula',
    'relative_url'  => '/js/components/dragula.min.js',
    'version'       => '1.0.1'
));
enqueue_js_backend(array(
    'name'          => 'jquery-form',
    'relative_url'  => '/js/components/jquery.form.js',
    'version'       => '1.0.1'
));
enqueue_js_backend(array(
    'name'          => 'jquery-cookie',
    'relative_url'  => '/js/components/jquery.cookie.min.js',
    'version'       => '1.0.1'
));
enqueue_js_backend(array(
  'name'          => 'dropzone-js',
  'relative_url'  => '/vendor/dropzone/dropzone.min.js',
  'version'       => '1.0.1'
));
enqueue_js_backend(array(
    'name'          => 'slick',
    'relative_url'  => '/js/components/slick.min.js',
    'version'       => '1.0.1'
));
enqueue_js_backend(array(
    'name'          => 'stag-material-form',
    'relative_url'  => '/vendor/stag-material-form/cmf.main.min.js',
    'version'       => '1.0.1'
));
if(defined('SLUG_ARRAY') && !empty(SLUG_ARRAY[1])){
    enqueue_js_backend(array(
        'name'          => SLUG_ARRAY[1],
        'relative_url'  => '/js/build/'.SLUG_ARRAY[1].'.js'
    ));
} else {
    enqueue_js_backend(array(
        'name'          => 'dashboard',
        'relative_url'  => '/js/build/dashboard.js',
        'version'       => '1.0.1'
    ));
}
enqueue_js_backend(array(
  'name'          => 'zu-functions',
  'relative_url'  => '/js/zu-form.js',
  'version'       => '1.0.1'
));
enqueue_js_backend(array(
    'name'          => 'ui-functions',
    'relative_url'  => '/js/ui-functions.js',
    'version'       => '1.0.1'
));
enqueue_js_backend(array(
    'name'          => 'main',
    'relative_url'  => '/js/main.js',
    'version'       => '1.0.1'
));


// enqueue_css(array(
//     'name'          => 'stag-icons',
//     'relative_url'  => '/cyzer-icons/style.css',
//     'version'       => '1.0.1',
//     'priority'      => '1',
//     'position'      => 'head',
//     'loading'       => 'async',
//     'view'          => 'backend-core'
// ));