<?php

/** API response template */
stag_include_controller('/functions/response-template.php', 'admin-api');

/** Secure internal api functions */
// stag_include_controller('/functions/secure-request-internal.php', 'admin-api');

/** Include URL Fetcher to fetch URLs */
require_once(STAG_LIB_DIR.'/file-upload/main.php');

/** Include StagON Installation and
 * update functionality */
require_once(STAG_COMPONENTS_DIR.'/core/update-management/stagon/install-update.php');

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

  if(!isset($_POST['zu-file-name']) && empty($_POST['zu-file-name'])) error_response(array(
    'description'   => 'Stagon Uploaded Failed: Filename not specified'
  ));

  /** File Name */
  $file_name = format_file_name($_POST['zu-file-name']);

  /** Upload instance */
  $cyz_upload = new cyz_upload($_FILES['zu-upload-field']);

  /** Upload argument */
  $upload_arg = array(
    'file-type-allowed'  => 'application',
    'extensions-allowed' => 'zip',
    'save-as'            => $file_name['name'],
    'save-location'      => '/cache/stagons-archive/'
  );

  /** Uploading */
  $result = $cyz_upload->upload_file($upload_arg);

  /** Success */
  if(true === $result['status']) {
    $_SESSION['stagon_file_name'] = $file_name['name'];

    success_response(array(
      'description'   => 'Stagon Uploaded Successfully!',
      'result'        => array('response' => TRUE)
    ));
  }

  /** Error */
  else error_response(array(
    'description'   => 'Stagon Uploaded Failed: '.$result['description']
  ));
}

else if('install' == $_POST['action']){
  if(!isset($_SESSION['stagon_file_name']) && empty($_SESSION['stagon_file_name']))
  error_response(array('description' => 'Invalid request!'));;

  if(install_stagon($_SESSION['stagon_file_name'])) success_response(array(
    'description'   => 'Stagon Installed Successfully!',
    'result'        => array('response' => TRUE)
  ));

  /** Error */
  else error_response(array(
    'description'   => 'Stagon Installation Failed'
  ));
}