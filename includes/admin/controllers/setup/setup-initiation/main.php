<?php
/**
 * StagPHP Setup - Welcome Section Functions
 *
 * @package StagPHP Core File
 */

/** Form Name - Used to identify form*/
$form = 'agreement_acceptance_form';
/** Form Action - Used to avoid action conflict */
$form_action = 'agreement_acceptance';
/** Process the POST request submitted using form after
 *  session token verification */
if(verify_form_token($form, $form_action)):

    /** Reset Installation Cache Memory */
    stag_session_cache::reset();
    stag_session_cache::add('su_config', 'su_panel_slug', 'su-panel');
    stag_session_cache::add('su_config', 'unique_session', 'ENABLED');
    stag_session_cache::add('su_config', 'ip_validation', 'DISABLED');
    stag_session_cache::add('stagphp_config', 'stag_debug', 'DISABLED');

    /** Redirect to database setup page */
    header("Location: ".get_home_url().'?setup=model-selection');
    exit;

/** Close if statement */
endif;
