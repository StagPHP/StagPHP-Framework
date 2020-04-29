<?php
/**
 * Name:            StagPHP Routing Function
 * Description:     This file contains functions related
 *                  to the routing standards
 * 
 * @package:        StagPHP Core File
 */

/** Direct route */
function stag_define_direct_route($defined_slug, $instance){
  /** Global variable */
  GLOBAL $IS_404; GLOBAL $IS_500; GLOBAL $ROUTE_COMPLETED;

  /** If route is not completed */
  if (isset($ROUTE_COMPLETED) || !empty($ROUTE_COMPLETED)) return;

  $IS_404 = TRUE;

  /** Current slug variable */
  $current_slug = get_current_slug();

  if (ADMIN_PANEL) {
    if (file_exists(STAG_ADMIN_DIR.$instance))
    $view_instance = STAG_ADMIN_DIR . $instance;
  }
  else {
    if (file_exists(STAG_APP_DIR.$instance))
    $view_instance = STAG_APP_DIR.$instance;
  }

  if ($defined_slug != $current_slug) {
    $IS_404 = TRUE;

    return;
  }

  if (!isset($view_instance)) $IS_500 = TRUE;

  $IS_404 = FALSE;

  $ROUTE_COMPLETED = TRUE;

  ob_clean();

  @require_once($view_instance);
}

/** Global route */
function stag_define_global_route($defined_slug, $instance){
  /** Global variable */
  GLOBAL $IS_404; GLOBAL $IS_500; GLOBAL $BASE_URL; GLOBAL $ROUTE_COMPLETED;

  /** If route is not completed */
  if (isset($ROUTE_COMPLETED) || !empty($ROUTE_COMPLETED)) return;

  $IS_404 = TRUE;

  /** Current slug variable */
  $current_slug = get_current_slug();

  if (ADMIN_PANEL) {
    if (file_exists(STAG_ADMIN_DIR.$instance)) $view_instance = STAG_ADMIN_DIR.$instance;
  }
  else {
    if (file_exists(STAG_APP_DIR.$instance)) $view_instance = STAG_APP_DIR.$instance;
  }

  $current_slug_array = SLUG_ARRAY;

  $defined_slug_array = array_values(array_filter(explode('/', $defined_slug)));

  /** process and validate */
  for ($i = 0; $i < count($defined_slug_array); $i++) {
    if ($defined_slug_array[$i] != $current_slug_array[$i]) return;
  }

  if (!isset($view_instance)) $IS_500 = TRUE;

  $BASE_URL = $defined_slug;

  $IS_404 = FALSE;

  ob_clean();

  @require_once($view_instance);
}

/** URL redirection function */
function stag_define_redirect($old_slug, $new_slug){
  $current_slug = get_current_slug();
  
  if ($old_slug == $current_slug) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: " . $new_slug);
    exit();
  }
}