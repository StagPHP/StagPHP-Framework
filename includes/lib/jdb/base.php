<?php
/**
 * JDB: JSON based noSQL Database
 * 
 * Base Configuration file
 *
 * @link https://stagphp.dev/db-setup/
 * @package StagPHP_app
 */


class cyz_jdb_base{
  /** Initialized Flag */
  private $initialized = false;

  /** DB location */
  private $db_loc;

  /** DB list array */
  private $db_list;

  /** DB files location */
  private $db_dir;

  /** Name of the DB */
  function __construct($dir){
    /** 
     * Removing trailing forward slash - if it
     * has any */
    if(substr($dir, -1) == '/') $dir = rtrim($dir, '/');
    
    /** Remove any file with directory name */     
    if(file_exists($dir)) @unlink($dir);
    
    /** Create Directory if does not exists */
    if(!is_dir($dir)) @mkdir($dir);

    /** Define JDB Directory Location */
    $this->db_loc = $dir;
  }

  protected function scan_db($path){
    /** Create blank array */
    $this->db_list = array();
  
    /** Scan nd get all files and folders */
    $files_n_folders = array_diff(scandir($path), array('.', '..'));

    /** Loop through files and folders */
    foreach($files_n_folders as $folder){

      /** If it is folder than push it to the array */
      if(is_dir($path."/$folder")) array_push($this->db_list, $folder);
    }
  }

  protected function delete_dir($dir){
    if (is_dir($dir)) { 
      $objects = scandir($dir); 
      foreach ($objects as $object) { 
        if ($object != "." && $object != "..") { 
          if (is_dir($dir."/".$object))
            $this->delete_dir($dir."/".$object);
          else
            unlink($dir."/".$object); 
        } 
      }
      rmdir($dir); 
    }
  }

  protected function scan_db_tables($path){
    /** Create blank array */
    $tables = array();
  
    /** Scan nd get all files and folders */
    $files_n_folders = array_diff(scandir($path), array('.', '..'));

    /** Loop through files and folders */
    foreach($files_n_folders as $file){

      /** If it is folder than push it to the array */
      if(!is_dir($path."/$file")) {
        $file = str_replace('.jdb', '', $file);
        array_push($tables, $file);
      }
    }

    return $tables;
  }

  Protected function get_db_names(){
    /** Directory location variable is empty */
    if(empty($this->db_loc)) return false;

    /** Scan DB Folders */
    $this->scan_db($this->db_loc);

    /** Return Updated DB List */
    return $this->db_list;
  }

  /** 
   * Delete DB Function will delete the DB with the 
   * DB name and its all associated files and folders.
   * 
   * @param:
   *    -> DB Name
   *
   * @return:
   *    -> true: If DB Deleted
   *    -> false: If DB Deletion failed */
  Protected function delete_db($db_name){
    /** Directory location variable is empty */
    if(empty($this->db_loc)) return false;

    /** define Database Folder Name */
    $this->db_dir = $this->db_loc."/$db_name";

    /** delete recursively */
    $this->delete_dir($this->db_dir);
  }

  /** DB Initialize */
  Protected function db_init($name){
    /** Directory location variable is empty */
    if(empty($this->db_loc)) return false;

    /** define Database Folder Name */
    $this->db_dir = $this->db_loc."/$name";

    /** Create Directory if does not exists */
    if(!is_dir($this->db_dir)) {
      /** Remove any file with directory name */     
      if(file_exists($this->db_dir)) @unlink($this->db_dir);

      if(mkdir($this->db_dir)) {
        /** Set initialized flag to true */
        $this->initialized = true;
        return true;
      }
      else return false;
    }

    /** Check if DB Directory exists and is writable */
    else if(is_dir($this->db_dir) && is_writable($this->db_dir)){
      /** Set initialized flag to true */
      $this->initialized = true;
      return true;
    }
    
    /** DB failed to initialize */
    return false;
  }

  protected function get_all_tables(){
    /** Check if this function is safe to execute */
    if(!$this->initialized) return false;

    return $this->scan_db_tables($this->db_dir);
  }

  Protected function table_exits($table_name){
    /** Check if table name is not empty */
    if(empty($table_name)) return false;

    /** Check if this function is safe to execute */
    if(!$this->initialized) return false;

    /** Check if table exists */
    if(file_exists($this->db_dir."/$table_name.jdb")) return true;
    else return false;
  }

  /**
   * Update Table: Replace the existing table data with
   * the new data provided.
   * 
   * @param: 
   *    -> table_name: Name of the table
   *    -> data: Table Data - Must be in array */
  Protected function update_table($table_name, $data = null){
    /** Check if table name is not empty */
    if(empty($table_name)) return false;

    /** Check if this function is safe to execute */
    if(!$this->initialized) return false;

    /** Table Location With Full Table Name */
    $table_file_loc = $this->db_dir."/$table_name.jdb";

    if(file_exists($table_file_loc)){
      /** Return error is it is not writable */
      if(!is_writable($table_file_loc)) return false;
    }

    /** If data is null, create blank data array */
    if(empty($data)) $data = null;
    else $data = json_encode($data);

    // Open the db file to write updated content
    $db_table = @fopen($table_file_loc, "w");

    /** Check file is valid */
    if($db_table){
      @fwrite($db_table, $data);
      @fclose($db_table);

      /** File updated successfully => return true */
      return true;
    }

    /** Incase error return false */
    return false;
  }

  /**
   * Update Table: Replace the existing table data with
   * the new data provided.
   * 
   * @param: 
   *    -> table_name: Name of the table
   * 
   * 
   * @return:
   *    -> Success: Data in array (Blank array if empty)
   *    -> Failure: Return false */
  Protected function read_table($table_name){
    /** Check if table name is not empty */
    if(empty($table_name)) return false;

    /** Check if this function is safe to execute */
    if(!$this->initialized) return false;

    /** Table Location With Full Table Name */
    $table_file_loc = $this->db_dir."/$table_name.jdb";

    /** Check if table exists */
    if(!$this->table_exits($table_name)) return false;

    /** Open db in memory */
    $db_table = file_get_contents($table_file_loc);

    // Decode JSON and sve it into an array
    $db_table = json_decode($db_table, true);
    
    if(empty($db_table)) return array();
    else return $db_table;
  }

  /**
   * Delete Table: Delete the existing table.
   * 
   * @param: 
   *    -> table_name: Name of the table
   * 
   * 
   * @return:
   *    -> Success: Return true
   *    -> Failure: Return false */
  Protected function delete_table($table_name){
    /** Check if table name is not empty */
    if(empty($table_name)) return false;

    /** Check if this function is safe to execute */
    if(!$this->initialized) return false;

    /** Table Location With Full Table Name */
    $table_file_loc = $this->db_dir."/$table_name.jdb";


    if($this->table_exits($table_name)) {
      if(unlink($table_file_loc)) return true;
    }
    
    // incase error return false
    return false;
  }

  protected function update_data_set($table_name, $index, $data_set){
    
    /** Check if table exists */
    if(!file_exists($this->db_dir."/$table_name")) {
      $this->update_table($table_name, $data = null);
    }
  }
}
