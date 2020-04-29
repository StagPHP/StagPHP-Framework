<?php
/**
 * Name:            StagPHP Load Superuser Panel Functions
 * Description:     This file contains functions related to load
 *                  StagPHP Superuser Panel and its components
 * 
 * @package:        StagPHP Core File
 */

// Create new user session object
$user_session = new stag_ums('SU', true);

/** 
 *  If verification fails
 *  Logout User and redirect it to Login Page */
if(false === $user_session->verify_session()) $user_session->logout('/su-panel/login');


/** Integrate Navigation With StagPHP */
stag_include_controller('/render-ui/navigation.php', 'admin');

/** Integrate Navigation With StagPHP */
stag_include_controller('/enqueue.php', 'admin');

/** Discover Plugins */
stag_discover_plugins();

/** Load active plugins */
stag_load_plugins();

/** Integrate view with admin panel */
stag_create_navigation_for_view_types();