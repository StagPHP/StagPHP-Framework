<?php

function stag_discover_plugins(){
    // Create new file manger instance
    $file_manager = new stag_file_manager('/');

    $files_n_folders = $file_manager->scan_directory(array(
        'directory' => '/container/stagons/'
    ));

    $stagons_data = array();
    
    foreach($files_n_folders['directories'] as $directory){
        $stagon_main_file = STAG_CONTAINER_DIR.'/stagons/'.$directory.'/'.$directory.'.php';

        if(file_exists($stagon_main_file)){
          $stagon_data = array('id' => $directory);
    
          // Phrase the comment
          $temp_result = stag_phrase_comment::file(
              $stagon_main_file,
              array('StagON Name', 'Version')
          );
    
          foreach($temp_result as $key => $value){
            $key = strtolower(str_replace(' ', '-', $key));
    
            $temp_array = array($key => $value);
    
            $stagon_data = array_merge($stagon_data, $temp_array);
          }
    
          array_push($stagons_data, $stagon_data);
        }
    }

    stag_model_add_stagons('simple', $stagons_data);
}

function integrate_plugins(){
  $stagons_list = discover_plugins();

  stag_model_add_stagons('simple', $stagons_list);
}

function get_compiled_plugin_list(){
  if(isset($_SESSION['stagons_refreshed'])){

  }
  
  else {
    // Get all stagons
    $all_stagons = stag_model_get_stagons('simple');

    // assuming noting is active
    $active_stagons_ids = stag_model_get_stagons('active');

    // Fully compiled list
    $active_stagons_list = array();
    $stagons_list = array();

    // Loop through StagONS
    foreach($all_stagons as $stagon){
      $stagon_id = $stagon['id'];
      $stagon_name = $stagon['stagon-name'];

      if(in_array($stagon_id, $active_stagons_ids)) $stagon_active = TRUE;
      else $stagon_active = FALSE;

      $stagon_main_file_path = STAG_CONTAINER_DIR.'/stagons/'.$stagon_id.'/'.$stagon_id.'.php';

      $index_uri = get_home_url();

      $img_light = STAG_CONTAINER_DIR.'/stagons/'.$stagon_id.'/assets/media/'.$stagon_id.'-light.hd.png';
      if(!file_exists($img_light)){
        $img_light = $index_uri.'/includes/admin/assets/media/stagons-hd.png';
      } else {
        $img_light = $index_uri.'/container/stagons/'.$stagon_id.'/assets/media/'.$stagon_id.'-light.hd.png';
      }

      $img_dark = STAG_CONTAINER_DIR.'/stagons/'.$stagon_id.'/assets/media/'.$stagon_id.'-dark.hd.png';
      if(!file_exists($img_dark)){
        $img_dark = $index_uri.'/includes/admin/assets/media/stagons-dark-hd.png';
      } else {
        $img_dark = $index_uri.'/container/stagons/'.$stagon_id.'/assets/media/'.$stagon_id.'-dark.hd.png';
      }

      // Phrase the comment
      $temp_result = stag_phrase_comment::file(
        $stagon_main_file_path,
        array('StagON Description', 'License', 'Docs URL')
      );

      $stagon_desc = $temp_result['StagON Description'];
      
      if(isset($stagon_desc) && !empty($stagon_desc)){
        if(strlen($stagon_desc) > 150){
          $stagon_desc = substr($stagon_desc, 0, 150);
          $stagon_desc .= '...'; 
        }
      } else $stagon_desc = '<span class="text-warning"><strong>WARNING:</strong> Description of this StagON is missing!</span>';
      
      if(isset($temp_result['License']) && !empty($temp_result['License']))
      $license = strtoupper($temp_result['License']);
      else $license = false;

      if(isset($temp_result['Docs URL']) && !empty($temp_result['Docs URL']))
      $docs = $temp_result['Docs URL'];
      else $docs = false;

      $stagon_compiled_data = array(
        'id'        => $stagon_id,
        'active'    => $stagon_active,
        'path'      => $stagon_main_file_path,
        'img_light' => $img_light,
        'img_dark'  => $img_dark,
        'title'     => $stagon_name,
        'desc'      => $stagon_desc,
        'license'   => $license,
        'docs'      => $docs,
      );


      if($stagon_active) array_push($active_stagons_list, $stagon_compiled_data); 
      else array_push($stagons_list, $stagon_compiled_data);
    }

    if(!empty($active_stagons_list) && !empty($stagons_list))
    $final_compiled_stagons_list = array_merge($active_stagons_list, $stagons_list);

    else if(empty($active_stagons_list) && !empty($stagons_list))
    $final_compiled_stagons_list = $stagons_list;

    else if(!empty($active_stagons_list) && empty($stagons_list))
    $final_compiled_stagons_list = $active_stagons_list;

    else $final_compiled_stagons_list = array();

    stag_model_add_stagons('compiled', $final_compiled_stagons_list);
  }

  return $final_compiled_stagons_list;
}

function stag_activate_plugins($stagons_id){
  // Get all stagons
  $all_stagons = stag_model_get_stagons('simple');

  $all_stagons_id = array();

  // Loop through StagONS
  foreach($all_stagons as $stagon){
    array_push($all_stagons_id, $stagon['id']);
  }

  foreach($stagons_id as $stagon_id)
  if (!in_array($stagon_id, $all_stagons_id))
  return FALSE;

  // Get active stagons
  $active_stagons = stag_model_get_stagons('active');

  if(empty($active_stagons)) $stagons_to_activate = $stagons_id;
  else $stagons_to_activate = array_merge($active_stagons, $stagons_id);

  // StagONS ID pushed into Active StagONS Table in DB
  stag_model_add_stagons('active', $stagons_to_activate);

  return TRUE;
}

function stag_deactivate_plugins($stagons_id){
  // Get all stagons
  $all_stagons = stag_model_get_stagons('simple');

  // Creating all stagons ID
  $all_stagons_id = array();

  // Loop through StagONS
  foreach($all_stagons as $stagon){
    array_push($all_stagons_id, $stagon['id']);
  }

  // In case there is some stagons forged by the hacker
  foreach($stagons_id as $stagon_id)
  if (!in_array($stagon_id, $all_stagons_id))
  return FALSE;

  // Get active stagons
  $active_stagons = stag_model_get_stagons('active');

  // Stagons to be activated
  $stagons_to_activate = array();

  // Loop through active stagons
  foreach($active_stagons as $active_stagon)
  /** Create a new list and keep only
   * those active stagons which are not
   * present in deactivate stagons list */
  if(!in_array($active_stagon, $stagons_id))
  array_push($stagons_to_activate, $active_stagon);

  // StagONS ID pushed into Active StagONS Table in DB
  stag_model_add_stagons('active', $stagons_to_activate);

  return TRUE;
}

function stag_load_plugins(){
  // Get all stagons
  $all_stagons = stag_model_get_stagons('simple');

  // assuming noting is active
  $active_stagons_ids = stag_model_get_stagons('active');

  // Fully compiled list
  $active_stagons_list = array();
  $stagons_list = array();

  // Loop through StagONS
  foreach($all_stagons as $stagon){
    $stagon_id = $stagon['id'];
    $stagon_name = $stagon['stagon-name'];

    if(in_array($stagon_id, $active_stagons_ids)) {
      $stagon_main_file_path = STAG_CONTAINER_DIR.'/stagons/'.$stagon_id.'/'.$stagon_id.'.php';

      if (file_exists( $stagon_main_file_path )) {
        @require_once($stagon_main_file_path);
      }
    }
  }
}