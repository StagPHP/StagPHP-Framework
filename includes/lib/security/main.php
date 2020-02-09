<?php

/** Create and returns session token
 *  @return unique token
 *  Token will be saved on session */
function get_form_token($form){
  // Token generated time difference in seconds
  $token_freshness = 6;

  // Form Token
  if(isset($_SESSION[$form.'_token'])) $form_token = $_SESSION[$form.'_token'];
  else $form_token = NULL;

  // Token Generated Timestamp
  if(isset($_SESSION[$form.'_token_gen_ts'])) $form_token_gen_ts = $_SESSION[$form.'_token_gen_ts'];
  else $form_token_gen_ts = NULL;

  /** Calculate Token Freshness
   * 
   * If token generated time difference in not empty
   * calculate time difference */
  if(!empty($form_token_gen_ts)){
      // Original Time
      $generated_time = strtotime($form_token_gen_ts);

      // Current Time
      $time_now = strtotime(date("H:i:s"));

      // Get difference in seconds
      $token_freshness = strtotime($time_now) - strtotime($generated_time);
  }

  /** Generate Form Token
   * 
   * If form token is empty or if token freshness is 
   * more than 6 seconds */
  if(empty($form_token) || $token_freshness > 5){
      // Generate  Unique Token
      $unique_token = md5(microtime(true));

      // Store token generated time stamp
      $_SESSION[$form.'_token_gen_ts'] = date("H:i:s");

      // Store token value
      $form_token = $_SESSION[$form.'_token'] = $unique_token;
  }

  // Return session token
  return $form_token;
}

/** Verify Session Token
 *  @return boolean */
function verify_form_token($form, $form_action){
  // Check Session and post fields
  if(!isset($_SESSION[$form.'_token']) || $_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['action']) || !isset($_POST['token'])) {
    return false;
  }

  // Match token and actions
  if($form_action != $_POST['action'] || $_SESSION[$form.'_token'] != $_POST['token']) {
    return false;
  }

  // Nullify form token session value
  $_SESSION[$form.'_token'] = null;
  return true;
}


function get_ajax_token($form){
  // Token generated time difference in seconds
  $token_freshness = 6;

  // Form Token
  $form_token = $_SESSION[$form.'_token'];

  // Token Generated Timestamp
  $form_token_gen_ts = $_SESSION[$form.'_token_gen_ts'];

  /** Calculate Token Freshness
   * 
   * If token generated time difference in not empty
   * calculate time difference */
  if(!empty($form_token_gen_ts)){
      // Original Time
      $generated_time = strtotime($form_token_gen_ts);

      // Current Time
      $time_now = strtotime(date("H:i:s"));

      // Get difference in seconds
      $token_freshness = strtotime($time_now) - strtotime($generated_time);
  }

  /** Generate Form Token
   * 
   * If form token is empty or if token freshness is 
   * more than 6 seconds */
  if(empty($form_token) || $token_freshness > 5){
      // Generate  Unique Token
      $unique_token = md5(microtime(true));

      // Store token generated time stamp
      $_SESSION[$form.'_token_gen_ts'] = date("H:i:s");

      // Store token value
      $form_token = $_SESSION[$form.'_token'] = $unique_token;
  }

  // Return session token
  return $form_token;
}


function verify_ajax_token($form, $form_action){
  // Check Session and post fields
  if(!isset($_SESSION[$form.'_token']) || $_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['action']) || !isset($_POST['token'])) {
    return false;
  }

  // Match token and actions
  if($form_action != $_POST['action'] || $_SESSION[$form.'_token'] != $_POST['token']) {
    return false;
  }

  // Nullify form token session value
  $_SESSION[$form.'_token'] = null;
  return true;
}
