<?php
/**
 * Name:            Stag Startup
 * Description:     This file is responsible for the StagPHP environment 
 *                  startup. If StagPHP is not installed properly it takes
 *                  the user to the installation screen.
 * 
 * @package:        StagPHP Core File
 */

/** Require - Global Path Definitions */
require_once(ABSPATH.'/includes/registry.php');

/** Require - StagPHP Bootup Function */
require_once(STAG_COMPONENTS_DIR.'/boot/functions.php');

/** Require - Route Functions */
require_once(STAG_COMPONENTS_DIR.'/core/routing/standards.php');

/** Require - Route Functions */
require_once(STAG_COMPONENTS_DIR.'/core/routing/junction.php');

/** Require - core Functions */
require_once(STAG_COMPONENTS_DIR.'/core/functions.php');

/** Start Initialization */
stag_startup();