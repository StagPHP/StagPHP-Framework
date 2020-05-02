<?php

function install_stagon($file_name){
  $stagon_upload_dir = '/cache/stagons-archive/';

  /** File Operator Object */
  $file_worker = new stag_file_manager('/');

  /** Move original directory */
  $result = $file_worker->extract_zip(array(
    'directory'             => $stagon_upload_dir,
    'zip_file'              => $file_name.'.zip',
    'destination_directory' => '/container/stagons/',
    'create_directories'    => TRUE
  ));

  if(TRUE !== $result['status']) return FALSE;

  $stagon_main_file = STAG_CONTAINER_DIR.'/stagons/'.$file_name.'/'.$file_name.'.php';

  if(!file_exists($stagon_main_file)) return FALSE;

  // Phrase the comment
  $temp_result = stag_phrase_comment::file($stagon_main_file, array('StagON Text Domain'));

  $stagon_text_domain = $temp_result['StagON Text Domain'];

  /** */
  $file_worker->delete_directory(array(
    'directory' => $stagon_upload_dir
  ));

  if($file_name != $stagon_text_domain) {
    /** */
    $file_worker->delete_directory(array(
      'directory' => '/container/stagons/'.$file_name
    ));

    return FALSE;
  }

  return TRUE;
}