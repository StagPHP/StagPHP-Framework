<?php

ini_set('upload_max_filesize', '60M');     
ini_set('max_execution_time', '999');
ini_set('memory_limit', '128M');
ini_set('post_max_size', '60M'); 

/** API response template */
stag_include_controller('/functions/response-template.php', 'admin-api');

/** Secure internal api functions */
// stag_include_controller('/functions/secure-request-internal.php', 'admin-api');

/** Include URL Fetcher to fetch URLs */
require_once(STAG_LIB_DIR.'/file-upload/main.php');

/** Include Application Deploy functionality */
require_once(STAG_COMPONENTS_DIR.'/core/update-management/app/deploy-app.php');

function format_file_name($filename){
  $file_name_original = str_replace("/.*(\/|\\)/", "", $filename);
  $file_name_array = explode('.', $file_name_original);

  // File Extension
  $extension = $file_name_array[count($file_name_array) - 1];

  // var_dump($extension);

  // File name without extension
  $filename = str_replace('.'.$extension, '', $file_name_original);
  $filename = preg_replace('/(^-+)|([^a-zA-Z0-9\-]+)|(-$)|(-{2,})/', "", $filename);

  return array(
    'name'      => $filename,
    'ext'       => $extension,
    'name-ext'  => $filename.'.'.$extension
  );
}

if(empty($_POST['action'])) error_response(array('description' => 'Invalid request!'));

else if('upload' == $_POST['action']){
  /** Upload instance */
  $cyz_upload = new cyz_upload($_FILES['zu-upload-field']);

  /** Upload argument */
  $upload_arg = array(
    'file-type-allowed'  => 'application',
    'extensions-allowed' => 'zip',
    'save-as'            => 'app',
    'save-location'      => '/cache/app-archive/'
  );

  /** Uploading */
  $result = $cyz_upload->upload_file($upload_arg);

  /** Success */
  if(true === $result['status']) {
    success_response(array(
      'description'   => 'Application Uploaded Successfully!',
      'result'        => array('response' => TRUE)
    ));
  }

  /** Error */
  else error_response(array(
    'description'   => 'Application Uploaded Failed: '.$result['description']
  ));
}

else if('install' == $_POST['action']){
  if(deploy_application()) success_response(array(
    'description'   => 'Application Installed Successfully!',
    'result'        => array('response' => TRUE)
  ));

  /** Error */
  else error_response(array(
    'description'   => 'Application Installation Failed'
  ));
}