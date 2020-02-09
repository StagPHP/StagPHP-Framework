<?php
/**
 * JDB: JSON based noSQL Database
 * 
 * Base Configuration file
 *
 * @link https://stagphp.dev/db-setup/
 * @package StagPHP_app
 */

/** If you are not using composer - than comment this out */
// namespace JDB;


require_once 'base.php';


/** JSON DB Class */
class CYZ_JDB extends cyz_jdb_base {

  function __construct($dir){
    /** Call parent Constructor */
    parent::__construct($dir);
  }

  /**
   * This function validates index value
   * 
   * @param:
   *    -> index value
   * 
   * @return:
   *    -> Success: Validated index value
   *    -> Failure: return false */
  private function validate_index($index){
    if(isset($index) && "integer" == gettype($index)){
      if(0 <= $index) return $index;
      else return 0;
    }

    /** If index value is not integer */
    return false;
  }


  /**
   * This function validates index value
   * 
   * @param:
   *    -> index value
   * 
   * @return:
   *    -> Success: Validated index value
   *    -> Failure: return false */
  private function validate_row($index){
    if(isset($index) && "integer" == gettype($index)){
      if(0 <= $index) return $index;
      else return 0;
    }

    /** If index value is not integer */
    return false;
  }


  /**
   * This function validates name
   * 
   * @param:
   *    -> index value
   * 
   * @return:
   *    -> Success: Validated index value
   *    -> Failure: return false */
  private function validate_name($name){
    if(isset($name)){
      $name = strtolower($name);

      $name = preg_replace("/[^\w\-]/i", "", $name);
      
      return $name;
    }

    /** If index value is not integer */
    return null;
  }


  /** 
   * DB Initialize 
   * 
   * @param:
   *    -> name - name of db
   * 
   * @return: As return by parent */
  function db_init($name){
    $name = $this->validate_name($name);

    if(empty($name)) return false;

    return parent::db_init($name);
  }


  /** 
   * Get All DB Names 
   * 
   * @return: DB Names - As return by parent */
  function get_db_names(){
    return parent::get_db_names();
  }


  /** 
   * Delete the specified db
   * 
   * @param: db_name
   * 
   * @return: As return by parent */
  function delete_db($db_name){
    $db_name = $this->validate_name($db_name);

    if(empty($db_name)) return false;

    return parent::delete_db($db_name);
  }


  /** Retrieve all the table name inside
   *  the db folder */
  function get_table_names(){
    return parent::get_all_tables();
  }


  /**
   * Get Table - Retrieve data of specified table. All the
   *             rows inside the table
   * 
   * @param:
   *    -> table_name: Name of the table from which data
   *                   has to be retrieve
   * @return:
   *    -> As return by parent */
  function get_table($table_name){
    return parent::read_table($table_name);
  }


  /** 
   * Add table - It add new blank table if table does not
   * exits 
   * 
   * @param:
   *    -> table_name: Name of the table to be added
   * 
   * @return: As return by parent */
  function add_table($table_name){
    $table_name = $this->validate_name($table_name);

    if(empty($table_name)) return false;

    /** Return true if table exists */
    if(parent::table_exits($table_name)) return true;

    /** Return result of update table */
    return parent::update_table($table_name, array());
  }


  /**
   * Delete Table - It deletes Table JSON file
   * 
   * @param:
   *    -> table_name: Name of the table to be deleted
   * 
   * @return: As return by parent */
  function delete_table($table_name){
    $table_name = $this->validate_name($table_name);

    if(empty($table_name)) return false;

    return parent::delete_table($table_name);
  }


  /**
   * Update Table - Update table with the data specified
   * 
   * @param:
   *    -> table_name: Name of the table to be updated
   *    -> data: Data to be updated
   * 
   * @return:
   *    -> As return by parent */
  function update_table($table_name, $data = null){
    $table_name = $this->validate_name($table_name);

    if(empty($table_name) || empty($data)) return false;

    /** Check table exists before updating */
    if(parent::table_exits($table_name)){
      return parent::update_table($table_name, $data);
    }

    return false;
  }

  
  /**
   * Get Row - Retrieve data of specified row 
   * 
   * @param:
   *    -> table_name: Name of the table from which
   *                   row data has to be retrieve
   *    -> row_index: index of the row
   *
   * @return:
   *    -> As return by parent */
  function get_row($table_name, $row_index){
    if(0 <= $this->validate_index($row_index)){
      return parent::read_table($table_name)[$row_index];
    }

    return false;
  }


  /**
   * Add Row - Add new row of data set to the table 
   * 
   * @param:
   *    -> table_name: Name of the table from which
   *                   row data has to be retrieve
   *    -> row_data:   Row data to be added
   *
   * @return:
   *    -> As return by parent */
  function add_row($table_name, $row_data){
    $table_data = parent::read_table($table_name);

    $columns = array();

    if(empty($table_data)) $table_data = array();
    else{
      foreach($table_data as $row_index => $row_data_set) {
        foreach($row_data as $column_key => $column_value) {
          if(!isset($table_data[$row_index][$column_key])){
            $table_data[$row_index][$column_key] = "";
          }
        }

        foreach($row_data_set as $column_key => $column_value) {
          if(!in_array($column_key, $columns)) array_push($columns, $column_key);
        }
      }

      foreach($columns as $column) {
        if(!isset($row_data[$column])) $row_data[$column] = "";
      }
    }

    array_push($table_data, $row_data);

    if(parent::update_table($table_name, $table_data)) return true;
    
    return false;
  }


  /**
   * Update Row - Updates the row existing
   * 
   * @param:
   *    -> table_name: Name of the table of which
   *                   row data has to be updated
   *    -> row_data:   Row data which has to be updated
   *
   * @return:
   *    -> As return by parent */
  function update_row($table_name, $row_index, $row_data){
    if(0 <= $this->validate_index($row_index)){
      $table_data = parent::read_table($table_name);

      if(empty($table_data)) return false;

      /** Loop through DB */
      foreach($table_data as $td_row_index => $td_row_data){
        if($row_index == $td_row_index){
          $table_data[$td_row_index] = $row_data;

          if(parent::update_table($table_name, $table_data)) return true;
        }
      }
    }
    
    return false;
  }


  /**
   * Delete Row - It deletes specified row in the table
   * 
   * @param:
   *    -> table_name: Name of the table of which
   *                   the row at specified index has
   *                   to be deleted
   *    -> row_index:  Specified Index of Row
   * 
   * @return: As return by parent */
  function delete_row($table_name, $row_index){
    if(0 <= $this->validate_index($row_index)){
      $table_data = parent::read_table($table_name);

      if(empty($table_data)) return true;

      /** Loop through DB */
      foreach($table_data as $td_row_index => $td_row_data){
        if($row_index == $td_row_index){
          array_splice($table_data, $row_index, 1);

          if(parent::update_table($table_name, $table_data)) return true;
        }
      }
    }
    
    return false;
  }


  /**
   * Add Column - Add column to all the row in the given table
   * 
   * @param:
   *    -> table_name:  Name of the table in which new column 
   *                    has to be added
   *    -> column_name: Name of the new column to be added
   * 
   * @return: As return by parent */
  function add_column($table_name, $column_name){
    $table_name = $this->validate_name($table_name);

    if(empty($table_name)) return false;

    $table_data = parent::read_table($table_name);

    if(empty($table_data)) return false;

    foreach ($table_data as $row_index => $row_data_set) {
      $table_data[$row_index][$column_name] = "";
    }

    if(parent::update_table($table_name, $table_data)) return true;

    return false;
  }

  function update_column_data($table_name, $index, $column_key, $column_data){
    $table_name = $this->validate_name($table_name);

    if(empty($table_name)) return false;

    $table_data = parent::read_table($table_name);

    if(empty($table_data)) return false;

    foreach ($table_data as $row_index => $row_data_set) {
      if($index == $row_index){
        $table_data[$row_index][$column_key] = $column_data;
      }
    }

    if(parent::update_table($table_name, $table_data)) return true;

    return false;
  }

  function get_column_data($table_name, $index, $column_key){
    $table_name = $this->validate_name($table_name);

    if(empty($table_name)) return false;

    $table_data = parent::read_table($table_name);

    if(empty($table_data)) return false;

    foreach ($table_data as $row_index => $row_data_set) {
      if($index == $row_index){
        return $row_data_set[$column_key];
      }
    }

    return false;
  }

  function delete_column($table_name, $column_key){
    $table_name = $this->validate_name($table_name);

    if(empty($table_name)) return true;

    $table_data = parent::read_table($table_name);

    if(empty($table_data)) return true;

    foreach ($table_data as $row_index => $row_data_set) {
      unset($row_data_set[$column_key]);

      $table_data[$row_index] = $row_data_set;
    }

    if(parent::update_table($table_name, $table_data)) return true;

    return false;
  }
}
