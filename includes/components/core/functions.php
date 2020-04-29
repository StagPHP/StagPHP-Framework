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

/** Include controller function
 * 
 * This function is used to include controller
 * anywhere from anywhere */
function stag_include_controller($file_path, $container){
  if(empty($file_path) || empty($container)) return;

  /** Global ERROR 500 variable */
  GLOBAL $IS_500;

  /** Exit incase of error */
  if($IS_500) exit;

  /** Function executing inside admin panel */
  if (ADMIN_PANEL) {
    /** Attach Controller from StagPHP Library Directory */
    if ('library' == $container) $file = STAG_LIB_DIR.$file_path;

    /** Attach Controller from StagPHP Admin Directory */
    else if ('admin' == $container) $file = STAG_ADMIN_CONTROLLERS_DIR.$file_path;

    /** Attach Controller from StagPHP Admin Directory */
    else if ('admin-api' == $container) $file = STAG_ADMIN_DIR.'/api'.$file_path;

    /** Attach Controller from StagPHP Components Directory */
    else if ('components' == $container) $file = STAG_COMPONENTS_DIR.$file_path;
  }

  /** Function executing inside application */
  else {
    /** Attach Controller from StagPHP Library Directory */
    if ('library' == $container) $file = STAG_LIB_DIR.$file_path;

    /** 
     * Attach Controller from StagPHP App, if default
     * controllers folder is not in used, custom folder
     * or path can be passed in $from_container argument */
    else if (!empty($from_container)) {
      $file = STAG_APP_DIR.str_replace('/(\/{2,})/', '/', '/'.$container.'/'.$file_path);
    }
  }

  /** Check file exists */
  if (!file_exists($file)) {
    if (STAGPHP_DEBUG_ENABLED) {
      $error_msg = 'Controller "'.$file_path.'" failed to load!';
    }

    /** Set ERROR 500 flag to TRUE */
    $IS_500 = TRUE;

    return;
  }

  /** Require and attach the controller */
  @require_once($file);
}