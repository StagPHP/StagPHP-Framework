<?php
/**
 * Name:            StagPHP Route Functions
 * Description:     This file contains functions related to routing
 * 
 * @package:        StagPHP Core File
 */

/** StagPHP Redirect Junction
 * 
 * This function separates URL of
 * the superuser panel and actual application */
function stag_route_junction(){
  /** Get Slug Array From Request URI */
  $slug_array_raw = explode('/', get_current_slug());

  /** Create Blank Slug Array */
  $slug_array = array();

  /** Recreate Slug Array using For Loop */
  foreach ($slug_array_raw as $val) {
    if ($val) array_push($slug_array, $val);
  }

  /** Define Slug Array */
  if (!defined('SLUG_ARRAY')) define('SLUG_ARRAY', $slug_array);

  /** Load StagPHP Application */
  if (empty($slug_array[0]) || ADMIN_PANEL_SLUG != $slug_array[0]) {
    /** Define Admin Panel */
    if (!defined('ADMIN_PANEL')) define('ADMIN_PANEL', FALSE);

    /** Check if StagAPP folder is created 
     * than load application */
    if (file_exists(STAG_APP_DIR)) require_once(STAG_COMPONENTS_DIR.'/boot/load/application.php');

    /** if StagAPP folder is created show No App Page */
    else if (empty($slug_array[0])) require_once(STAG_ADMIN_VIEWS_DIR.'/utils/no-app.php');

    else {
      GLOBAL $IS_404;
      
      $IS_404 = TRUE;
    }
  }

  /** Load StagPHP Superuser Panel */
  else if(ADMIN_PANEL_SLUG == $slug_array[0]) {
    /** Define Admin Panel */
    if (!defined('ADMIN_PANEL')) define('ADMIN_PANEL', TRUE);

    require_once(STAG_COMPONENTS_DIR.'/boot/load/admin-panel.php');
  }
}