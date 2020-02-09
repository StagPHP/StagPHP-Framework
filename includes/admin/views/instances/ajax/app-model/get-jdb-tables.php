<?php


stag_attach_controller('/jdb/JDB.php', 'library');


// Create new user session object
$user_session = new stag_ums('SU', true);


/** 
 *  If verification fails
 *  Logout User and redirect it to Login Page */
if(false === $user_session->verify_session()) {
  echo json_encode(array(
    'status'      => 'failed',
    'response'    => null,
    'description' => 'Authentication Failed'
  ));
}


if('get-db-names' == $_POST['action']){
  $jdb = new CYZ_JDB(STAG_CONTAINER_DIR.'/jdb/');


  // Get DB
  $db_names = $jdb->get_db_names();


  echo json_encode(array(
    'status'      => 'success',
    'response'    => $db_names,
    'description' => 'Database names fetched'
  ));
}
