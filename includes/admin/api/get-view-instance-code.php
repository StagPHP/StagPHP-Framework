<?php

function get_view_instance_code($name, $number){
    $views_from_db = stag_model_get_view_list_of_types($name);
  
    if(empty($views_from_db)) return false;
    
    else {
      foreach($views_from_db as $key => $val){
        if($name.'.'.$number == $views_from_db[$key]['id']){        
          
          $path_of_file = $views_from_db[$key]['abs_location'];
  
          $file_data_raw = file_get_contents($path_of_file);
  
          return $file_data_raw;
        }
      }
    }
  
    return false;
  }


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
