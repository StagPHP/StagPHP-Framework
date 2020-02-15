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

/** Require - Global Path Definitions */
require_once(STAG_COMPONENTS_DIR.'/boot/functions.php');

/** Require - Global Path Definitions */
require_once(STAG_COMPONENTS_DIR.'/boot/shutdown.php');

/** Require - Route Functions */
require_once(STAG_COMPONENTS_DIR.'/core/routing/functions.php');

/** Include form fields */
require_once(STAG_COMPONENTS_DIR.'/helpers/get-urls.php');

/** StagPHP Memory Cache */
require_once(STAG_COMPONENTS_DIR.'/core/memory-cache.php');

/** StagPHP Session Cache */
require_once(STAG_COMPONENTS_DIR.'/core/session-cache.php');

/** Require - Core functions */
require_once(STAG_COMPONENTS_DIR.'/core/integration/hooks.php');

/** Require - Error reporting function */
require_once(STAG_COMPONENTS_DIR.'/core/error-reporting.php');

/** Require - Base64 Modded */
require_once(STAG_COMPONENTS_DIR.'/core/base64-modded.php');

/** Integrate Application With StagPHP */
require_once(STAG_COMPONENTS_DIR.'/core/templating-engine/functions.php');

/** Start Initialization */
stag_startup();