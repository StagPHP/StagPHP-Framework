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
$form_error = array();
if(verify_form_token($form, $form_action)):
  /** Validate */ 
  $valid = cyz_input_validate('username', $_POST['sender-name']);
  /** If valid store the username */
  if($valid[0]) $sender_name = $_POST['sender-name'];
  /** If not valid then push the error to form error */
  else array_push($form_error, 'Sender Name: '.$valid[1]);

  /** Validate */ 
  $valid = cyz_input_validate('email', $_POST['sender-email']);
  /** If valid store the email */
  if($valid[0]) $sender_email = $_POST['sender-email'];
  /** If not valid then push the error to form error */
  else array_push($form_error, 'Sender Email: '.$valid[1]);

  /** Validate */ 
  $valid = cyz_input_validate('username', $_POST['reply-to-name']);
  /** If valid store the username */
  if($valid[0]) $reply_to_name = $_POST['reply-to-name'];
  /** If not valid then push the error to form error */
  else array_push($form_error, 'Reply To Name: '.$valid[1]);

  /** Validate */ 
  $valid = cyz_input_validate('email', $_POST['reply-to-email']);
  /** If valid store the email */
  if($valid[0]) $reply_to_email = $_POST['reply-to-email'];
  /** If not valid then push the error to form error */
  else array_push($form_error, 'Sender Email: '.$valid[1]);


  /** Validate: Admin panel URL */ 
  $valid = cyz_input_validate('slug', $_POST['backend-url']);
  /** If valid store the username */
  if($valid[0]) $backend_url = $_POST['backend-url'];
  /** If not valid then push the error to form error */
  else array_push($form_error, 'Super User Slug: '.$valid[1]);

  /** Unique Session Validation */
  $unique_session = ('enabled' == $_POST['enable-unique-session']) ? 'ENABLED' : 'DISABLED';

  /** IP Validation */
  $ip_validation = ('enabled' == $_POST['enable-ip-validation']) ? 'ENABLED' : 'DISABLED';

  /** Debug Validation */
  $debug = ('enabled' == $_POST['enable-debug']) ? 'ENABLED' : 'DISABLED';

  /** Return form error */
  if(0 == count($form_error)){
    stag_session_cache::add('email_settings', 'sender-name', $sender_name);
    stag_session_cache::add('email_settings', 'sender-email', $sender_email);

    $reply_to_name = stag_session_cache::get_data('user_credential', 'name');
    $reply_to_email = stag_session_cache::get_data('user_credential', 'email'); 

    stag_session_cache::add('email_settings', 'reply-to-name', $reply_to_name);
    stag_session_cache::add('email_settings', 'reply-to-email', $reply_to_email);

    stag_session_cache::add('su_config', 'su_panel_slug', $backend_url);
    stag_session_cache::add('su_config', 'unique_session', $unique_session);
    stag_session_cache::add('su_config', 'ip_validation', $ip_validation);
    stag_session_cache::add('stagphp_config', 'stag_debug', $debug);

    /** Redirect to database setup page */
    header("Location: ".get_home_url().'/?setup=completed');
    exit;
  }

  /** Errors */
  $error = base64_encode(serialize($form_error));

  // Redirect to error instance URL
  header("Location: ".get_home_url().'?setup=error&desc='.$error.'&url=final-step');
  exit;

/** Close if statement */
endif;