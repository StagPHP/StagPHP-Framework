<?php
/**
 * StagPHP Setup - Welcome Section Functions
 *
 * @package StagPHP Core File
 */

/** Form Name - Used to identify form*/
$form = 'build_selection_form';
/** Form Action - Used to avoid action conflict */
$form_action = 'build_selection';
/** Process the POST request submitted using form after
 *  session token verification */
if(verify_form_token($form, $form_action)):
    $selected_build = 'hybrid-build';

    if(!isset($_POST['stagphp-build'])){    
        // Redirect to error instance URL
        header("Location: ".get_home_url().'?setup=error');
        exit;
    }

    elseif('db-build' == $_POST['stagphp-build'])
    $selected_build = 'db-build';

    elseif('lite-build' == $_POST['stagphp-build'])
    $selected_build = 'lite-build';

    /** Reset Installation Cache Memory */
    stag_session_cache::reset();

    stag_session_cache::add('su_config', 'su_panel_slug', 'su-panel');
    stag_session_cache::add('su_config', 'unique_session', 'ENABLED');
    stag_session_cache::add('su_config', 'ip_validation', 'DISABLED');

    stag_session_cache::add('stagphp_config', 'stag_build', $selected_build);
    stag_session_cache::add('stagphp_config', 'stag_debug', 'DISABLED');

    /** Redirect to database setup page */
    header("Location: ".get_home_url().'?setup=apache');
    exit;

/** Close if statement */
endif;
