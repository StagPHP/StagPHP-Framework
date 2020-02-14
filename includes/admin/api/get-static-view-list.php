<?php

/** API response template */
stag_attach_controller('/functions/response-template.php', 'admin-api');

/** Secure internal api functions */
stag_attach_controller('/functions/secure-request-internal.php', 'admin-api');

if(empty($_POST['name']) || empty($_POST['action']) || empty($_POST['offset'])){
  error_response(array(
    'description' => 'Invalid request!',
  ));
}

if('get' == $_POST['action']){
  $view_list = stag_model_get_view_list_of_types($_POST['name']);

  if($view_list){
    success_response(array(
      'description'   => 'Views list fetched!',
      'result'        => array(
        'view-list'       => $view_list
      )
    ));
  } else {
    error_response(array(
      'description'   => 'Views list failed to fetch!'
    ));
  }
}

else if('refresh-view' == $_POST['action']){
  stag_update_static_view_list($_POST['name']);

  success_response(array(
    'description'   => 'Views list database updated!',
    'result'        => array()
  ));
}