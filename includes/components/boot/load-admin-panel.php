<?php
/**
 * Name:            StagPHP Load Superuser Panel Functions
 * Description:     This file contains functions related to load
 *                  StagPHP Superuser Panel and its components
 * 
 * @package:        StagPHP Core File
 */

/** Include UMS script for
 * User Management System */
stag_attach_controller('/ums/ums.php', 'library');

/** Include file management script file management operation */
stag_attach_controller('/cmd/main.php', 'library');

/** Include CLI CMD script for
 * command line execution */
stag_attach_controller('/file-manager/file-manager.php', 'library');

/** StagPHP Parse Comment */
stag_attach_controller('/core/parse-comment.php', 'components');

/** StagPHP Update Functionality */
stag_attach_controller('/core/update-management/core/functions.php', 'components');

/** StagPHP Maintenance Page */
stag_attach_controller('/core/maintenance/functions.php', 'components');

/** Integrate URL routing logic With StagPHP */
stag_attach_controller('/core/integration/routing.php', 'components');

/** Include app DB main library */
stag_attach_controller('/jdb/JDB.php', 'library');

/** Setting Global - APP JSON DB Object */
GLOBAL $APP_JSON_DB;

/** Creating JSON DB Object */
$APP_JSON_DB = new CYZ_JDB(STAG_CONTAINER_DIR.'/jdb/');

/** Include app DB main library */
stag_attach_controller('/core/model/jdb/app-model.php', 'components');

/** Integrate Application With StagPHP */
stag_attach_controller('/core/integration/app/main.php', 'components');

/** Integrate Application With StagPHP */
stag_attach_controller('/core/integration/plugins/main.php', 'components');

/** Integrate view with admin panel */
integrate_plugins();

/** Integrate Navigation With StagPHP */
stag_attach_controller('/render-ui/navigation.php', 'admin');

/** Integrate Navigation With StagPHP */
stag_attach_controller('/enqueue.php', 'admin');

/** Get Admin Routing */
stag_attach_controller('/routing/main.php', 'admin');

/** Integrate view with admin panel */
stag_create_navigation_for_view_types();
