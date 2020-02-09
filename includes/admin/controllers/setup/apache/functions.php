<?php
/**
 * StagPHP Apache Setup functions
 *
 * @package StagPHP
 */

/** Function returns htaccess content */
function cyz_get_htaccess_content(){
  /** Get the Rewrite base for Apache */
  $rewrite_base = stag_get_rewrite_base();

  /** Formatting Variable */
  $nl = "\r\n";
  $nls = "\r\n ";

  /** Apache Configuration */
  $apache_content = "# STAGPHP APACHE CONFIG$nl<IfModule mod_rewrite.c>$nls RewriteEngine On$nl$nls # REWRITE BASE$nls RewriteBase $rewrite_base$nl$nls # REQUEST HANDLING$nls RewriteCond %{REQUEST_FILENAME} !-f$nls RewriteCond %{REQUEST_FILENAME} !-d$nls RewriteRule ^(.*) index.php [NC,L,QSA]$nl</IfModule>";

  return $apache_content;
}

/** Actual function which creates htaccess file */
function cyz_create_htaccess(){
  // Get htaccess dynamic content
  $htaccess_content = cyz_get_htaccess_content();

  /** Directory where apache htaccess Filename */
  $apache_filename = '.htaccess';

  /** File Operator Object */
  $file_worker = new stag_file_manager('/');

  $htaccess_status = $file_worker->get_info(array('path' => '/'.$apache_filename));

  if(TRUE === $htaccess_status['status']) {
    $file_worker->delete_file(array(
      'directory'   => '/',
      'file_name'   => $apache_filename
    ));
  }
  
  /** Create new/update htaccess file */
  $htaccess_updated = $file_worker->update_file(array(
    'directory'             => '/',
    'file_name'             => $apache_filename,
    'file_content'          => $htaccess_content,
    'create_directories'    => TRUE,
    'create_file'           => TRUE
  ));

  /** Htaccess file has been updated */
  if($htaccess_updated['status']) return [
    'status' => true,
    'description' => ''
  ];

  /** Error updating Htaccess file */
  else return [
    'status' => false,
    'description' => 'Please delete old .htaccess file.'
  ];
}