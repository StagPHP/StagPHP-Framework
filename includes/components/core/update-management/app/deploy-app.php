<?php

function deploy_application(){
  $app_upload_dir = '/cache/app-archive/';

  /** File Operator Object */
  $file_worker = new stag_file_manager('/');

  /** Move original directory */
  $result = $file_worker->extract_zip(array(
    'directory'             => $app_upload_dir,
    'zip_file'              => 'app.zip',
    'destination_directory' => '/',
    'create_directories'    => TRUE
  ));

  if(TRUE !== $result['status']) return FALSE;

  // $app_main_index_file = STAG_APP_DIR.'/index.php';

  // if(!file_exists($app_main_index_file)) return FALSE;

  // // Phrase the comment
  // $temp_result = stag_phrase_comment::file($app_main_index_file, array('Text Domain'));

  // $text_domain = $temp_result['Text Domain'];

  // /** */
  // $file_worker->delete_directory(array(
  //   'directory' => $app_upload_dir
  // ));

  // if(empty($text_domain)){
  //   /** */
  //   $file_worker->delete_directory(array(
  //     'directory' => '/app'
  //   ));

  //   return FALSE;
  // }

  return TRUE;
}