<?php
/**
 * Name:            StagPHP Core Functions
 * Description:     This file contains functions related to the core
 * 
 * @package:        StagPHP Core File
 */

/** Add Action Hook
 * 
 * This hook act as a queue of functions stored in
 * associated global variable which is based  on
 * action type
 * 
 * @param
 *    -> action_type  => Set of predefined actions.
 *    -> function     => Name of function to be
 *                       executed.
 * 
 * @return
 *    -> Void */
function stag_add_action($action_type, $function_name){
    /** Set of predefined actions */
    $predefined_actions_types = array(
        'start',
        'ready',
        'processed'
    );
  
    /** Loop Through Action */
    foreach($predefined_actions_types as $predefined_action_type){
        /** If predefined action matches with action type */
        if($predefined_action_type == $action_type){
  
            /** Define a global variable of action type */
            $GLOBALS[$action_type];
    
            /** If global variable of action type is empty
             * set this variable as a blank array. */
            if(empty($GLOBALS[$action_type])) $GLOBALS[$action_type] = array();
    
            /** Push function names as a function identifier 
             * into the global variable of action array */
            array_push($GLOBALS[$action_type], $function_name);
        }
    }
}

/** Attach controller function
 * 
 * This function is used to attach controller */
function stag_attach_controller($absolute_file_path, $from_container = null){
    /** Attach Controller from StagPHP Library Directory */
    if('library' == $from_container) $file = STAG_LIB_DIR.$absolute_file_path;

    /** Attach Controller from StagPHP Admin Directory */
    elseif('admin' == $from_container) $file = STAG_ADMIN_CONTROLLERS_DIR.$absolute_file_path;

    /** Attach Controller from StagPHP Admin Directory */
    elseif('admin-api' == $from_container) $file = STAG_ADMIN_DIR.'/api'.$absolute_file_path;

    /** Attach Controller from StagPHP Components Directory */
    elseif('components' == $from_container) $file = STAG_COMPONENTS_DIR.$absolute_file_path;

    /** 
     * Attach Controller from StagPHP App, if default
     * controllers folder is not in used, custom folder
     * or path can be passed in $from_container argument */
    elseif(!empty($from_container)) $file = STAG_APP_DIR.$from_container.$absolute_file_path;

    /** Attach Controller from StagPHP APP Controllers */
    else $file = STAG_APP_DIR.'/controllers'.$absolute_file_path;

    if(STAGPHP_DEBUG_ENABLED){
        /** Require and attach the controller */
        if(file_exists($file)) require_once($file);
        
        else {
            $error_msg = 'Controller not found, with absolute path ('.$absolute_file_path.')';
    
            if(!empty($from_container)) $error_msg .= ' from container ('.$from_container.')';
        }
    } else {
        /** Require and attach the controller */
        @require_once($file);
    }
}

/** Insert template function
 * 
 * This function is used to insert template into view */
function stag_insert_template($absolute_file_path, $from_container = null){
    /** Attach Template from StagPHP Library Directory */
    if('library' == $from_container) include(STAG_LIB_DIR.$absolute_file_path);

    /** Attach Template from StagPHP Admin Directory */
    elseif('admin' == $from_container) include(STAG_ADMIN_VIEWS_DIR.$absolute_file_path);

    /** Attach Template from StagPHP Components Directory */
    elseif('components' == $from_container) include(STAG_COMPONENTS_DIR.$absolute_file_path);

    /** 
     * Attach Template from StagPHP App, if default
     * views folder is not in used, custom folder
     * or path can be passed in $from_container argument */
    elseif(!empty($from_container)) include(STAG_APP_DIR.$from_container.$absolute_file_path);

    /** Attach Template from StagPHP APP Views */
    else include(STAG_APP_DIR.$absolute_file_path);
}