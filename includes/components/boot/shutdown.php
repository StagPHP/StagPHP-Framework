<?php
/**
 * Name:            StagPHP Shutdown Function
 * Description:     This will executes when StagPHP completes
 *                  one request completely and terminates.
 * 
 * @package:        StagPHP Core File
 */

// Shutdown Function
function stag_shutdown(){
    // print_computation();

    GLOBAL $APP_VIEW_LOADED;
    GLOBAL $VIEW_LOADED;
    GLOBAL $APP_404;

    if($APP_404){
        if($APP_VIEW_LOADED && file_exists(STAG_APP_DIR.'/views/404.php')) require_once(STAG_APP_DIR.'/views/404.php');
        else require_once(STAG_ADMIN_VIEWS_DIR.'/utils/404.php');
    }

    if(FALSE === $VIEW_LOADED) require_once(STAG_ADMIN_VIEWS_DIR.'/utils/500.php');

    ob_end_flush();
}

function stag_register_shutdown(){
    /** Registering StagPHP Shutdown Function */
    register_shutdown_function('stag_shutdown');
}