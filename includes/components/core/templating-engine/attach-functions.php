<?php
/**
 * Name:        StagPHP Core Functions
 * Description: This file contains functions related to the core
 * 
 * @package:    StagPHP Core File
 */

/** Attach controller
 * 
 * This function is used to attach controller */
function stag_attach_controller($controller_relative_path){
  /** Global ERROR 500 variable */
  GLOBAL $IS_500;

  /** Exit incase of error */
  if($IS_500) exit;

  /** Attach Controller from StagPHP Admin Directory */
  if (ADMIN_PANEL) {
    $file = STAG_ADMIN_CONTROLLERS_DIR.$controller_relative_path;
  }

  /** Attach Controller from StagPHP APP Controllers */
  else {
    $file = STAG_APP_DIR.'/controllers'.$controller_relative_path;
  }

  /** Check file exists */
  if (!file_exists($file)) {
    if (STAGPHP_DEBUG_ENABLED) {
      $error_msg = 'Controller "'.$controller_relative_path.'" failed to load!';
    }

    /** Set ERROR 500 flag to TRUE */
    $IS_500 = TRUE;

    return;
  }

  /** Require and attach the controller */
  @require_once($file);
}

/** Attach controller based on path
 * 
 * This function is used to attach controller 
 * based on the path specified */
function stag_attach_controller_based_on_path($data){
  /** Global ERROR 500 variable */
  GLOBAL $IS_500;

  /** Exit incase of error */
  if ($IS_500) exit;

  /** Global base URL variable 
   * 
   * It will be created during routing */
  GLOBAL $BASE_URL;

  /** Return if base URL is empty */
  if (empty($BASE_URL)) return;

  /** Get current slug */
  $current_slug = get_current_slug();

  foreach ($data as $key => $value) {
    $slug = preg_replace('/(\/{2})/', '/', $BASE_URL.$key);

    if ($current_slug == $slug) {

      if (!isset($value['controller'])) return;

      $controller_relative_path = $value['controller'];

      /** Attach Controller from StagPHP Admin Directory */
      if (ADMIN_PANEL) {
        $file = STAG_ADMIN_CONTROLLERS_DIR.$controller_relative_path;
      }

      /** Attach Controller from StagPHP APP Controllers */
      else {
        $file = STAG_APP_DIR.'/controllers'.$controller_relative_path;
      }

      /** Check file exists */
      if (!file_exists($file)) {
        if (STAGPHP_DEBUG_ENABLED) {
          $error_msg = 'Controller "'.$controller_relative_path.'" failed to load!';
        }

        /** Set ERROR 500 flag to TRUE */
        $IS_500 = TRUE;

        return;
      }

      /** Require and attach the controller */
      @require_once($file);

      /** Complete this function */
      return;    
    }
  }
}

/** Attach controller
 * 
 * This function is used to attach controller */
function stag_attach_instance($instance_relative_path){
  /** Global ERROR 500 variable */
  GLOBAL $IS_500;

  /** Exit incase of error */
  if($IS_500) exit;

  /** Attach instance from StagPHP admin directory */
  if (ADMIN_PANEL) {
    $file = STAG_ADMIN_VIEWS_DIR.$instance_relative_path;
  }

  /** Attach instance from StagPHP APP directory */
  else {
    $file = STAG_APP_DIR.'/views'.$instance_relative_path;
  }

  /** Check file exists */
  if (!file_exists($file)) {
    if (STAGPHP_DEBUG_ENABLED) {
      $error_msg = 'Instance "'.$instance_relative_path.'" failed to load!';
    }

    /** Set ERROR 500 flag to TRUE */
    $IS_500 = TRUE;

    return;
  }

  /** Require and attach the controller */
  @require_once($file);
}

/** Attach controller based on path
 * 
 * This function is used to attach controller 
 * based on the path specified */
function stag_attach_instance_based_on_path($data){
  /** Global ERROR 404 & 500 variable */
  GLOBAL $IS_404; GLOBAL $IS_500; GLOBAL $ROUTE_COMPLETED;

  /** Exit incase of error */
  if ($IS_500) exit;

  /** If route is not completed */
  if (isset($ROUTE_COMPLETED) || !empty($ROUTE_COMPLETED)) return;

  $IS_404 = TRUE;

  /** Global base URL variable 
   * 
   * It will be created during routing */
  GLOBAL $BASE_URL;

  /** Return if base URL is empty */
  if (empty($BASE_URL)) return;

  /** Get current slug */
  $current_slug = get_current_slug();

  foreach ($data as $key => $value) {
    $slug = preg_replace('/(\/{2})/', '/', $BASE_URL.$key);

    if ($current_slug == $slug) {

      $instance_relative_path = $value['instance'];

      if (empty($instance_relative_path)) return;

      /** Attach instance from StagPHP admin directory */
      if (ADMIN_PANEL) {
        $file = STAG_ADMIN_VIEWS_DIR.$instance_relative_path;
      }

      /** Attach instance from StagPHP APP directory */
      else {
        $file = STAG_APP_DIR.'/views'.$instance_relative_path;
      }

      /** Check file exists */
      if (file_exists($file)) {
        /** Require and attach the controller */
        @require_once($file);

        $IS_404 = FALSE;

        $ROUTE_COMPLETED = TRUE;

        /** Complete this function */
        return;
      }

      else {
        if (STAGPHP_DEBUG_ENABLED) {
          $error_msg = 'Instance "'.$instance_relative_path.'" failed to load!';
        }

        /** Set ERROR 500 flag to TRUE */
        $IS_500 = TRUE;

        return;
      }
    }
  }

  return;
}

/** Attach controller
 * 
 * This function is used to attach controller */
function stag_attach_template($template_relative_path){
  /** Global ERROR 500 variable */
  GLOBAL $IS_500;

  /** Exit incase of error */
  if($IS_500) exit;

  /** Attach instance from StagPHP admin directory */
  if (ADMIN_PANEL) {
    $file = STAG_ADMIN_VIEWS_DIR.$template_relative_path;
  }

  /** Attach template from StagPHP APP directory */
  else {
    $file = STAG_APP_DIR.'/views'.$template_relative_path;
  }

  /** Check file exists */
  if (!file_exists($file)) {
    if (STAGPHP_DEBUG_ENABLED) {
      $error_msg = 'Template "'.$template_relative_path.'" failed to load!';
    }

    /** Set 500 flag to TRUE */
    $IS_500 = TRUE;

    return;
  }

  /** Require and attach the controller */
  @include($file);
}

function stag_attach_template_based_on_path($data){
  /** Global ERROR 500 variable */
  GLOBAL $IS_500;

  /** Exit incase of error */
  if ($IS_500) exit;

  /** Global base URL variable 
   * 
   * It will be created during routing */
  GLOBAL $BASE_URL;

  /** Return if base URL is empty */
  if (empty($BASE_URL)) return;

  /** Get current slug */
  $current_slug = get_current_slug();

  foreach ($data as $key => $value) {
    $slug = preg_replace('/(\/{2})/', '/', $BASE_URL.$key);

    if ($current_slug == $slug) {

      $template_relative_path = $value;

      if (empty($template_relative_path)) return;

      /** Attach template from StagPHP admin directory */
      if (ADMIN_PANEL) {
        $file = STAG_ADMIN_VIEWS_DIR.$template_relative_path;
      }

      /** Attach template from StagPHP APP directory */
      else {
        $file = STAG_APP_DIR.'/views'.$template_relative_path;
      }

      /** Check file exists */
      if (!file_exists($file)) {
        if (STAGPHP_DEBUG_ENABLED) {
          $error_msg = 'Template "'.$template_relative_path.'" failed to load!';
        }
    
        /** Set 500 flag to TRUE */
        $IS_500 = TRUE;
    
        return;
      }

      /** Require and attach the controller */
      @include($file);

      /** Complete this function */
      return;
    }
  }
}