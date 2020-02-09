<?php
/**
 * Name:            StagPHP Load Application Functions
 * Description:     This file contains functions related to load
 *                  StagPHP application and its components
 * 
 * @package:        StagPHP Core File
 */

/** 
 * Check if Application Main Functions file
 * exits. Include it if it does. */
if(file_exists(STAG_APP_DIR.'/controllers/functions.php'))
require_once(STAG_APP_DIR.'/controllers/functions.php');

/** 
 * Check if Application Main Routing file
 * exits. Include it if it does. */
if(file_exists(STAG_APP_DIR.'/controllers/routing.php'))
require_once(STAG_APP_DIR.'/controllers/routing.php');

/** 
 * Check if Application Main Redirect file
 * exits. Include it if it does. */
if(file_exists(STAG_APP_DIR.'/controllers/redirect.php'))
require_once(STAG_APP_DIR.'/controllers/redirect.php');
