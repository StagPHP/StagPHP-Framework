<?php

/** Include Apache HTACCESS setup file */
stag_attach_controller('/ajax/app-view/function.php', 'admin');


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



if(!empty($_POST['name']) && !empty($_POST['action']) && !empty($_POST['offset'])){
  if('get' == $_POST['action']){

    $view_list = get_view_instances($_POST['name']);

    if($view_list) echo_result('Latest views list fetched', $view_list);
    else echo_error('Un Authorised Access');
    
  } elseif('refresh-view' == $_POST['action']){

    update_view_instances($_POST['name']);

    echo_result('Success', 'DB Updated');

  } else echo_error('Un Authorised Access');
} else echo_error('Error Occurred');
