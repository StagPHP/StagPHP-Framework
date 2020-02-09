<?php

/** Include Apache HTACCESS setup file */
stag_attach_controller('/ajax/get-code/function.php', 'admin');


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


if(!empty($_POST['id'])){

  $data_set = explode('.', $_POST['id']);
  $name = $data_set[0];
  $number = $data_set[1];

  $code = get_view_instance_code($name, $number);
  
  if($code) echo_result('Success', $code);
  else echo_error('Un Authorised Access!');

} else echo_error('Error Occurred');
