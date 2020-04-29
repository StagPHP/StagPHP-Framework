<?php
/**
 * Name:            StagPHP Registry and Definition
 * Description:     Contains several global defined variable
 *
 * @package:        StagPHP Core File
 */


/**
 * StagPHP Framework Version Identifier
 * 
 * Purpose:   Defining the Global Variable storing STAG_VERSION */
if(!defined('STAG_VERSION')) define('STAG_VERSION', '1.0.6');


/** StagPHP APP Directory */
if(!defined('STAG_APP_DIR'))
define('STAG_APP_DIR', ABSPATH.'/app');

/** StagPHP APP Directory */
if(!defined('STAG_CACHE_DIR'))
define('STAG_CACHE_DIR', ABSPATH.'/cache');

/** StagPHP APP Directory */
if(!defined('STAG_CONTAINER_DIR'))
define('STAG_CONTAINER_DIR', ABSPATH.'/container');

/** StagPHP APP Directory */
if(!defined('STAG_ADMIN_DIR'))
define('STAG_ADMIN_DIR', ABSPATH.'/includes/admin');

/** StagPHP APP Directory */
if(!defined('STAG_COMPONENTS_DIR'))
define('STAG_COMPONENTS_DIR', ABSPATH.'/includes/components');

/** StagPHP APP Directory */
if(!defined('STAG_LIB_DIR'))
define('STAG_LIB_DIR', ABSPATH.'/includes/lib');

/** StagPHP APP Directory */
if(!defined('STAG_ADMIN_CONTROLLERS_DIR'))
define('STAG_ADMIN_CONTROLLERS_DIR', STAG_ADMIN_DIR.'/controllers');

/** StagPHP APP Directory */
if(!defined('STAG_ADMIN_VIEWS_DIR'))
define('STAG_ADMIN_VIEWS_DIR', STAG_ADMIN_DIR.'/views');
