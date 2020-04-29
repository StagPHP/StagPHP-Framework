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

    /** Redirect to database setup page */
    header("Location: ".get_home_url().'?setup=model-selection');
    exit;

/** Close if statement */
endif;