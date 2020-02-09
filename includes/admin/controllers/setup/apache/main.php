<?php
/**
 * StagPHP Apache Setup File
 * Contains Apache Predefined Settings
 *
 * @package StagPHP
 */


/** Config Setup functions */
require_once 'functions.php';

/** Run Apache Setup */
$setup_apache = cyz_create_htaccess();

/** Once Apache Setup Completes -> Check Status */
if($setup_apache['status']):

  /** Redirect to database setup page */
  header("Location: ".get_home_url()."/?setup=db");
  exit;

/** If Apache Setup Fails */
else:

  /** Error description */
  $error = base64_encode(serialize([$setup_apache['description']]));

  // Redirect to error instance URL
  header("Location: ".get_home_url()."/?setup=error&desc=".$error."&url=apache");
  exit;

// End If Statement
endif;
