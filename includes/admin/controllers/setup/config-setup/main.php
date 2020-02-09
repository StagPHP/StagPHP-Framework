<?php

/** Config Setup functions */
require_once 'functions.php';

/** Store error while processing */
$error = array();

$config_creator = new config_creator;

$config_content = $config_creator->compile_config();

/** Config File Constructor */
function stag_create_config_file($file_name, $content){
    /** File Operator Object */
    $file_worker = new stag_file_manager('/');
  
    /** Create new/update config file */
    $config_file_updated = $file_worker->update_file(array(
      'directory'             => '/',
      'file_name'             => $file_name,
      'file_content'          => $content,
      'create_directories'    => TRUE,
      'create_file'           => TRUE
    ));
  
    /** Config file has been created / updated */
    if($config_file_updated['status']) return [
      'status' => TRUE,
      'description' => 'Config file created!'
    ];
  
    /** Error updating config file */
    else return [
      'status' => FALSE,
      'description' => 'Config file creation failed!'
    ];
}

$config_file = stag_create_config_file('stag.config.php', $config_content);

if($config_file['status']){
    /** Redirect to database setup page */
    header("Location: ".get_home_url().'/su-panel');
    exit;
}

else array_push($error, $config_file['description']);

/** Return form error */
if(count($error) > 0){
    $error = base64_encode(serialize($form_error));
    
    // Redirect to error instance URL
    header("Location: ".get_home_url().'?setup=error&desc='.$error.'&url=completed');
    exit;
}