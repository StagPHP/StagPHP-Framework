<?php

/** Application Routing */
function stag_add_route($defined_slug, $instance, $is_backend = false){
    $current_slug = get_current_slug();

    if($is_backend) $url = STAG_ADMIN_VIEWS_DIR.$instance;
    else $url = STAG_APP_DIR.$instance;
    
    if($defined_slug == $current_slug){       
        GLOBAL $APP_404;
        $APP_404 = false;

        require_once($url);
    }
}