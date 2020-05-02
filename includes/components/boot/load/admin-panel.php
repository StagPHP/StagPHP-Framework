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

/** Include User Management System */
require_once(STAG_LIB_DIR.'/ums/ums.php');

/** Include CLI script for
 * command line execution */
require_once(STAG_LIB_DIR.'/cmd/main.php');

/** Include file management
 * script file management operation */
require_once(STAG_LIB_DIR.'/file-manager/file-manager.php');

/** Include app DB main library */
require_once(STAG_LIB_DIR.'/jdb/JDB.php');

/** Include app DB main library */
require_once(STAG_LIB_DIR.'/mysql/main.php');

// =============================================
// Essential Components
// =============================================

/** Require core routing functions */
require_once(STAG_COMPONENTS_DIR.'/core/routing/functions.php');

/** StagPHP Memory Cache */
require_once(STAG_COMPONENTS_DIR.'/core/memory-cache.php');

/** StagPHP Session Cache */
require_once(STAG_COMPONENTS_DIR.'/core/session-cache.php');

/** Require - Error reporting function */
require_once(STAG_COMPONENTS_DIR.'/core/error-reporting.php');

/** Require - Base64 Modded */
require_once(STAG_COMPONENTS_DIR.'/core/base64-modded.php');

/** StagPHP Parse Comment */
require_once(STAG_COMPONENTS_DIR.'/core/parse-comment.php');

/** StagPHP Update Functionality */
require_once(STAG_COMPONENTS_DIR.'/core/update-management/core/functions.php');

/** StagPHP Maintenance Page */
require_once(STAG_COMPONENTS_DIR.'/core/maintenance/functions.php');

/** Require attach functionality
 * From templating engine */
require_once(STAG_COMPONENTS_DIR.'/core/templating-engine/attach-functions.php');

/** Require enqueue functionality
 * From templating engine */
require_once(STAG_COMPONENTS_DIR.'/core/templating-engine/enqueue.php');

/** Require enqueue functionality
 * From templating engine */
require_once(STAG_COMPONENTS_DIR.'/core/templating-engine/templating.php');

/** Include app DB main library */
require_once(STAG_COMPONENTS_DIR.'/core/model/jdb/app-model.php');

/** Integrate Application With StagPHP */
require_once(STAG_COMPONENTS_DIR.'/core/integration/app/functions.php');

/** Integrate Application With StagPHP */
require_once(STAG_COMPONENTS_DIR.'/core/integration/stagons/main.php');

// =============================================
// Loading Admin Panel
// =============================================

/** Get Admin Routing */
require_once(STAG_ADMIN_CONTROLLERS_DIR.'/routing/main.php');