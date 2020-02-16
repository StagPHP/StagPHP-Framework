<?php
/**
 * StagPHP Setup - Welcome Section Functions
 *
 * @package StagPHP Core File
 */

/** Form Name - Used to identify form*/
$form = 'security_setting_form';
/** Form Action - Used to avoid action conflict */
$form_action = 'security_setting';
/** Process the POST request submitted using form after
 *  session token verification */
if(verify_form_token($form, $form_action)):

    /** Validate: Superuser username */ 
    $valid = cyz_input_validate('username', $_POST['admin-panel-url']);
    /** If valid store the username */
    if($valid[0]) $admin_panel_url = $_POST['admin-panel-url'];
    /** If not valid then push the error to form error */
    else array_push($form_error, 'Superuser ID: '.$valid[1]);

    if($admin_panel_url){
        
    }

    elseif('db-build' == $_POST['stagphp-build'])
    $selected_build = 'db-build';

    elseif('lite-build' == $_POST['stagphp-build'])
    $selected_build = 'lite-build';

    stag_session_cache::add('stagphp_config', 'stag_build', $selected_build);

    /** Redirect to database setup page */
    header("Location: ".get_home_url().'/?setup=completed');
    exit;

/** Close if statement */
endif;
