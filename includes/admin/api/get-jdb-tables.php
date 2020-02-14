<?php


if('get-db-names' == $_POST['action']){
  GLOBAL $APP_JSON_DB;

  // Get DB
  $db_names = $APP_JSON_DB->get_db_names();


  echo json_encode(array(
    'status'      => 'success',
    'response'    => $db_names,
    'description' => 'Database names fetched'
  ));
}
