<?php

ignore_user_abort(true);

/** Include URL Fetcher to fetch URLs */
stag_attach_controller('/file-manager/file-manager.php', 'library');

/** Include URL Fetcher to fetch URLs */
stag_attach_controller('/core/update-management/core/init.php', 'components');

function echo_error($desc){
  echo json_encode(array(
    'status'        => 'failed',
    'description'   => $desc
  ));

  exit;
}

function echo_result($desc, $result){
  echo json_encode(array(
    'status'        => 'success',
    'description'   => $desc,
    'response'      => $result
  ));

  exit;
}

// Echo error if action is not defined
if(empty($_POST['action'])) echo_error('Access Denied!');

// Check For Update
else if('check-core-update' == $_POST['action']){

  $response = stag_is_update_available();

  if($response[0]) echo_result('update-available', $response[1]);
  else echo_result('update-to-date', $response[1]);
}

// Download Core Update
else if('download-core-update' == $_POST['action']){
  if(TRUE !== stag_download_latest_build()) echo_error('Download Failed!');

  echo_result('Core update downloaded', 'downloaded');
}

// Install Update
else if('install-update' == $_POST['action']){
  stag_initialize_core_update();
}

else echo_error('Error Occurred');
