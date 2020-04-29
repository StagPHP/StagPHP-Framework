<?php
/**
 * Name:            StagPHP Load Superuser Panel Functions
 * Description:     This file contains functions related to load
 *                  StagPHP Superuser Panel and its components
 * 
 * @package:        StagPHP Core File
 */

// =============================================
// Essential Libraries
// =============================================

/** Include file management
 * script file management operation */
require_once(STAG_LIB_DIR.'/file-manager/file-manager.php');

/** Include app DB main library */
require_once(STAG_LIB_DIR.'/jdb/JDB.php');

// =============================================
// Essential Components
// =============================================

/** Include form fields */
require_once(STAG_COMPONENTS_DIR.'/helpers/get-urls.php');

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

// =============================================
// Loading Admin Panel
// =============================================

/** Get Admin Routing */
require_once(STAG_ADMIN_VIEWS_DIR.'/setup.php');