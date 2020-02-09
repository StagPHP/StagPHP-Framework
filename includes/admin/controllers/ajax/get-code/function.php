<?php

/** Include URL Fetcher to fetch URLs */
stag_attach_controller('/jdb/JDB.php', 'library');


function get_view_db_data($db_name){
  $JSON_DB = new CYZ_JDB(STAG_CONTAINER_DIR.'/jdb/');

  $JSON_DB->db_init($db_name);

  return $JSON_DB->get_table('views');
}


function get_view_instance_code($name, $number){
  $views_from_db = get_view_db_data($name);

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
