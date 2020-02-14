<?php

ignore_user_abort(true);

/** API response template */
stag_attach_controller('/functions/response-template.php', 'admin-api');

/** Secure internal api functions */
stag_attach_controller('/functions/secure-request-internal.php', 'admin-api');

/** Core update management controllers */
stag_attach_controller('/core/update-management/core/init.php', 'components');

/** Error response if action is not defined */
if(empty($_POST['action'])) error_response('Request not specified!');

/** Check For Update */
else if('check-update' == $_POST['action']){
    /** Check for StagPHP update */
    $response = stag_is_update_available();

    /** Success response: Update available */
    if($response[0]) success_response(array(
        'description'   => 'Update status successfully checked, new update available!',
        'result'        => array(
            'response'      => TRUE,
            'version'       => $response[1]
        )
    ));

    /** Success response: No update available */
    success_response(array(
        'description'   => 'Update status successfully checked, no update available!',
        'result'        => array(
            'response'      => FALSE,
            'version'       => STAG_VERSION
        )
    ));
}

/** Check For Update */
else if('check-requirement' == $_POST['action']){
    /** Success response after downloading
     * latest build of StagPHP */
    if(TRUE === stag_check_update_requirements())
    success_response(array(
        'description'   => 'Currently configured environment is suitable for automatic update!',
        'result'        => array(
            'response'      => TRUE
        )
    ));

    /** Success response: No update available */
    error_response(array(
        'description'   => 'Currently configured environment is not suitable for automatic update!'
    ));
}

/** Download core update */
else if('core-backup' == $_POST['action']){
    /** Success response after downloading
     * latest build of StagPHP */
    if(TRUE === stag_backup_includes())
    success_response(array(
        'description'   => 'StagPHP core backup created!',
        'result'        => array(
            'response'      => TRUE
        )
    ));

    /** Error response download failed */
    error_response(array(
        'description'   => 'StagPHP core backup failed!',
    ));
}

/** Download core update */
else if('download-update' == $_POST['action']){
    /** Success response after downloading
     * latest build of StagPHP */
    if(TRUE === stag_download_latest_build())
    success_response(array(
        'description'   => 'StagPHP update downloaded!',
        'result'        => array(
            'response'      => TRUE
        )
    ));

    /** Error response download failed */
    error_response(array(
        'description'   => 'StagPHP update download failed!',
    ));
}

/** Download core update */
else if('extract-files' == $_POST['action']){
    /** Success response after downloading
     * latest build of StagPHP */
    if(TRUE === stag_extract_latest_build())
    success_response(array(
        'description'   => 'Files extracted successfully!',
        'result'        => array(
            'response'      => TRUE
        )
    ));

    /** Error response download failed */
    error_response(array(
        'description'   => 'File extraction failed!',
    ));
}

/** Install update */
else if('install-update' == $_POST['action']){
    /** Initialize core update */
    stag_initialize_core_update('lite');
}

/** Install update */
else if('finish-update' == $_POST['action']){
    /** Success response after downloading
     * latest build of StagPHP */
    if(TRUE === stag_clean_update_residue())
    success_response(array(
        'description'   => 'Installation finished!',
        'result'        => array(
            'response'      => TRUE
        )
    ));

    /** Error response download failed */
    error_response(array(
        'description'   => 'Installation finished, cleanup failed!',
    ));
}

/** Error response */
else error_response('Invalid request!');