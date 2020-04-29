<?php
/**
 * Name:            StagPHP Boot Functions
 * Description:     This file contains functions required
 *                  to boot up the StagPHP framework
 * 
 * @package:        StagPHP Core File
 */

/** StagPHP startup function */
function stag_startup(){
  /** Start Object buffer */
  ob_start();

  /** Execution startup timestamp as a  Global Variable
   * 
   * Store the micro time from the moment StagPHP starts. This
   * micro time stamp will be used for performance monitoring
   * and optimization */
  GLOBAL $EXECUTION_START;
  $EXECUTION_START = microtime(true);

  /** 404 Status Flag */
  GLOBAL $VIEW_LOADED;

  /** 404 Status Flag */
  GLOBAL $IS_404;
  $IS_404 = FALSE;

  /** 500 Status Flag */
  GLOBAL $IS_500;
  $IS_500 = FALSE;

  /** Rewrite URL */
  stag_structure_url();

  /** Create URL */
  stag_create_index_url();

  /** Start Session */
  if(session_status() == PHP_SESSION_NONE) session_start();

  /** Registering StagPHP Shutdown Function
   * 
   * Out Object buffer and shutdown the
   * execution of current script */
  register_shutdown_function('stag_shutdown');

  if(file_exists(ABSPATH.'/stag.config.php')){
    /** 
     * Check Pre prerequisite
     * Include StagPHP Configuration File */
    require_once(ABSPATH.'/stag.config.php');

    /** Re-write Completed - Setting Up App Started Flag */
    if(!defined('APP_STARTED')) define('APP_STARTED', true);

    /** Check for apache file - run Apache setup
     * if file not found! */
    if(!file_exists(ABSPATH.'/.htaccess')) cyz_create_htaccess();

    /** Disable Debug by Default */
    if(!defined('STAGPHP_DEBUG_ENABLED')) define('STAGPHP_DEBUG_ENABLED', FALSE);

    /** Include form fields */
    require_once(STAG_COMPONENTS_DIR.'/helpers/get-urls.php');

    stag_route_junction();
  }

  else {
    /** Disable Debug */
    if(!defined('STAGPHP_DEBUG_ENABLED')) define('STAGPHP_DEBUG_ENABLED', FALSE);

    /** Define Admin Panel */
    if (!defined('ADMIN_PANEL')) define('ADMIN_PANEL', TRUE);

    /** If StagPHP is not configured
     * 
     * Run StagPHP Framework Installation */
    require_once(STAG_COMPONENTS_DIR.'/boot/load/stag-setup.php');
  }
}

/** Shutdown Function */
function stag_shutdown(){
  /** 404 & 500 Status Flag */
  GLOBAL $IS_404; GLOBAL $IS_500;

  /** Error Pages for Admin Panel */
  if (ADMIN_PANEL) {
    if ($IS_500) {
      ob_clean();
    
      require_once(STAG_ADMIN_VIEWS_DIR.'/utils/500.php');
    }
    else if ($IS_404) {
      ob_clean();
    
      require_once(STAG_ADMIN_VIEWS_DIR.'/utils/404.php');
    }
  }

  /** Error Pages for Application */
  else {
    if ($IS_500) {
      ob_clean();

      if (file_exists(STAG_APP_DIR.'/views/500.php')) require_once(STAG_APP_DIR.'/views/500.php');

      else require_once(STAG_ADMIN_VIEWS_DIR.'/utils/500.php');
    }
    else if ($IS_404) {
      ob_clean();
      
      if (file_exists(STAG_APP_DIR.'/views/404.php')) require_once(STAG_APP_DIR.'/views/404.php');

      else require_once(STAG_ADMIN_VIEWS_DIR.'/utils/404.php');
    }
  }

  /** Output Object buffer */
  ob_end_flush();
}