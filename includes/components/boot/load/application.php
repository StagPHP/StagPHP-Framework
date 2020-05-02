<?php
/**
 * Name:            StagPHP Load Application Functions
 * Description:     This file contains functions related to load
 *                  StagPHP application and its components
 * 
 * @package:        StagPHP Core File
 */


/** Require core routing functions */
require_once(STAG_COMPONENTS_DIR.'/core/routing/functions.php');

/** StagPHP Memory Cache */
require_once(STAG_COMPONENTS_DIR.'/core/memory-cache.php');

/** StagPHP Session Cache */
require_once(STAG_COMPONENTS_DIR.'/core/session-cache.php');

/** Require attach functionality
 * From templating engine */
require_once(STAG_COMPONENTS_DIR.'/core/templating-engine/attach-functions.php');

/** Require enqueue functionality
 * From templating engine */
require_once(STAG_COMPONENTS_DIR.'/core/templating-engine/enqueue.php');

/** Require enqueue functionality
 * From templating engine */
require_once(STAG_COMPONENTS_DIR.'/core/templating-engine/templating.php');

/** Integrate Application With StagPHP */
require_once(STAG_COMPONENTS_DIR.'/core/application/functions.php');


// =============================================
// Loading Admin Panel
// =============================================

/** Check if Application Main Functions file
 * exits. Include it if it does. */
if(file_exists(STAG_APP_DIR.'/functions.php'))
require_once(STAG_APP_DIR.'/functions.php');

/** Check if Application Main Routing file
 * exits. Include it if it does. */
if(file_exists(STAG_APP_DIR.'/routing.php'))
require_once(STAG_APP_DIR.'/routing.php');

/** Check if Application Main Redirect file
 * exits. Include it if it does. */
if(file_exists(STAG_APP_DIR.'/redirects.php'))
require_once(STAG_APP_DIR.'/redirects.php');
