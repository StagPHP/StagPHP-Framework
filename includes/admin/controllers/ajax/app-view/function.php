<?php

/** Include URL Fetcher to fetch URLs */
stag_attach_controller('/jdb/JDB.php', 'library');

class STAG_APP_DIR_dir_scanner{
  private $parent_dir_path = '';
  private $nested = '';

  private $files_n_folders = array();

  function __construct($path){
    $this->parent_dir_path = STAG_APP_DIR."/$path";
  }

  private function scan_dir($path = null){
    // Create first nest
    if(empty($this->nested)) $this->nested = $this->parent_dir_path;

    // Create second nest
    if($path) $this->nested = $this->nested.'/'.$path;

    $files = array_diff(scandir($this->nested), array('.', '..'));

    foreach($files as $file){

      if(is_dir($this->nested.'/'.$file)) {
        // array_push($this->files_n_folders, $file);

        if('templates' == $file) return;

        $this->scan_dir($file);

        // Reset nested
        $this->nested = dirname($this->nested);
      } else {
        array_push($this->files_n_folders, array(
          'file_name' => $file,
          'file_loc'  => $this->nested.'/'.$file
        ));
      }
    }
  }

  function get_all(){
    $this->scan_dir();

    return $this->files_n_folders;
  }
}


function get_view_instance($path){
  $scanner = new STAG_APP_DIR_dir_scanner($path);

  $all_files = $scanner->get_all();

  $view_instances = array();

  foreach($all_files as $file){
    if(preg_match('/(.*\.view\.php)/', $file['file_name'])){
      array_push($view_instances, $file);
    }
  }

  return $view_instances;
}


function update_view_db($db_name, $table_data){
  /** Initialize APP JSON DB Object */
  $JSON_DB = new CYZ_JDB(STAG_CONTAINER_DIR.'/jdb/');

  $JSON_DB->db_init($db_name);

  $JSON_DB->add_table('views');

  return $JSON_DB->update_table('views', $table_data);
}


function get_view_db_data($db_name){
  /** Initialize APP JSON DB Object */
  $JSON_DB = new CYZ_JDB(STAG_CONTAINER_DIR.'/jdb/');

  $JSON_DB->db_init($db_name);

  return $JSON_DB->get_table('views');
}


function update_view_instances($name){
  $all_views = get_view_instance('views');

  $new_db_data = array();

  foreach($all_views as $key => $view){
    $result = stag_phrase_comment::file($view['file_loc'], array("View", "Name", "Date Create", "Date Updated"));

    if($name == $result['View']){

      $created_time = strtotime($result['Date Create']);
      $created_time = date('Y-m-d',$created_time);

      $updated_time = strtotime($result['Date Updated']);
      $updated_time = date('Y-m-d',$updated_time);

      /** Get Full URL of the file */
      $full_root = str_replace('\\', '/', $view['file_loc']);

      // /** Get Document URL */
      // $doc_root = rtrim(ABSPATH.'/', '/').'/';

      // echo $full_root;

      // /** Removing Document Root from Directory URL */
      // $url = explode($doc_root, $full_root)[1];


      $new_row = array(
        'id'            => $name.'.'.($key + 1),
        'instance_name' => $result['Name'],
        'date_created'  => $created_time,
        'date_updated'  => $updated_time,
        'abs_location'  => $full_root
      );

      array_push($new_db_data, $new_row);

    }
  }

  update_view_db($name, $new_db_data);
}


function get_view_instances($name){
  $views_from_db = get_view_db_data($name);

  if(empty($views_from_db)) return false;
  
  return $views_from_db;
}
