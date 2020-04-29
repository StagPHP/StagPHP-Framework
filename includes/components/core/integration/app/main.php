<?php

/** Integrate Application With StagPHP */
stag_include_controller('/core/integration/app/view/functions.php', 'components');

/** Include Watcher and Compiler Scripts */
stag_include_controller('/core/integration/app/functions.php', 'components');

/** Check if StagPHP DB is configured */
if(file_exists(STAG_APP_DIR.'/controllers/integrate.defs.php')){
    // Get App integration file for configuration
    require_once(STAG_APP_DIR.'/controllers/integrate.defs.php');
}