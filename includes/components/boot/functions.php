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

    /**
     * Execution startup timestamp as a  Global Variable
     * 
     * Store the micro time from the moment StagPHP starts. This
     * micro time stamp will be used for performance monitoring
     * and optimization */
    GLOBAL $EXECUTION_START;
    $EXECUTION_START = microtime(true);

    /** App view loaded */
    GLOBAL $APP_VIEW_LOADED;
    $APP_VIEW_LOADED = FALSE;

    /** Define 404 Page */
    GLOBAL $VIEW_LOADED;
    $VIEW_LOADED = TRUE;

    /** Define 404 Page */
    GLOBAL $APP_404;
    $APP_404 = TRUE;

    /** Rewrite URL */
    stag_structure_url();

    /** Create URL */
    stag_create_index_url();

    // Start Session
    if(session_status() == PHP_SESSION_NONE) session_start();

    /** Out Object buffer and shutdown the execution of current script */
    stag_register_shutdown();

    if(file_exists(ABSPATH.'/stag.config.php')){
        /** 
         * Check Pre prerequisite
         * Include StagPHP Configuration File */
        require_once(ABSPATH.'/stag.config.php');

        // /** Re-write Completed - Setting Up App Started Flag */
        if(!defined('APP_STARTED')) define('APP_STARTED', true);

        // /** Check for apache file - run Apache setup
        //  * if file not found! */
        if(!file_exists(ABSPATH.'/.htaccess')) cyz_create_htaccess();

        /** Disable Debug by Default */
        if(!defined('STAGPHP_DEBUG_ENABLED')) define('STAGPHP_DEBUG_ENABLED', FALSE);

        stag_route_junction();
    }

    else {
        /** Disable Debug */
        if(!defined('STAGPHP_DEBUG_ENABLED')) define('STAGPHP_DEBUG_ENABLED', FALSE);

        /** Integrate Navigation With StagPHP */
        stag_attach_controller('/enqueue.php', 'admin');
    
        /** 
         * If StagPHP is not configured Start StagPHP setup
         * Start StagPHP Framework Installation 
         * 
         * Require Install View */
        require_once(STAG_ADMIN_VIEWS_DIR.'/instances/setup/install.php');
    }
}