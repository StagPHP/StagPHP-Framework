<?php

/** Application Routing */
function stag_add_route($defined_slug, $instance, $is_backend = false){
    /** View instance variable */
    $view_instance;

    /** Current slug variable */
    $current_slug = get_current_slug();

    if($is_backend) {
        if(file_exists(STAG_ADMIN_DIR.$instance)) $view_instance = STAG_ADMIN_DIR.$instance;
    } else {
        if(file_exists(STAG_APP_DIR.$instance)) $view_instance = STAG_APP_DIR.$instance;
    }
    
    if($defined_slug == $current_slug){       
        GLOBAL $APP_404;
        $APP_404 = FALSE;

        if(empty($view_instance)){    
            GLOBAL $VIEW_LOADED;
            $VIEW_LOADED = FALSE;
        } else {
            require_once($view_instance);
        }
    }
}