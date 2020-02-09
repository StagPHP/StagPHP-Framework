<?php

require_once 'functions.php';

/** User Session Management Main Class */
class stag_ums extends stag_ums_base {

  /** DB Type */
  private $db_type;

  /** DB Table Name */
  private $table_name;

  /** DB Salt Field Name */
  private $db_salt = 'su_login_salt';

  /** DB IP Field Name */
  private $db_ip = 'su_ip';

  /** DB Browser ID Field Name */
  private $browser_id = 'su_browser_id';


  /** Main constructor function */
  function __construct($db_table_name,  $db_type = false){
    /** Call parent Constructor */
    parent::__construct();

    /** Setting up database type */
    if(true == $db_type) $this->db_type = 'json_db';
    else $this->db_type = 'sql_db';

    /** Setting up table name */
    if(isset($db_table_name)) $this->table_name = $db_table_name;
  }


  /** Create New Session */
  function create_session($username, $password, $remember){

    // Super User Session Management
    if('json_db' == $this->db_type && 'SU' == $this->table_name) {
      $user_db = new CYZ_JDB(STAG_CONTAINER_DIR.'/jdb/');

      $user_db->db_init('su');  

      // get all super user data
      $users_data = $user_db->get_table($this->table_name);

      foreach($users_data as $key => $user_data){
        if($username == $user_data['su_username']){

          /** Encrypt password hash */
          $password = md5($password);

          /**
           * Compare password hash
           * return false if password hash comparison fails */
          if($password != $user_data['su_password']) return array(
            'status'      => false,
            'description' => 'Password does not match!'
          );

          // Destroy Old Session
          if(isset($user_data['session_id'])){
            session_id($user_data['session_id']);
            session_start();
            session_destroy();
          }

          // Create new super user session
          // Set Double Encrypted Password
          $session_id = parent::create_session($username, md5($password), $remember);

          /**
           * Update DB with session salt
           * and browser ID */
          $user_db->update_row(
            $this->table_name,
            $key,
            array(
              'su_username'       => $user_data['su_username'],
              'su_password'       => $user_data['su_password'],
              'session_id'        => $session_id,
              $this->db_salt      => parent::get_cookie_salt(),
              $this->db_ip        => parent::get_user_ip(),
              $this->browser_id   => parent::get_user_agent(),
            )
          );
    
          // Close DB connection
          $user_db = null;
    
          return array(
            'status'      => true,
            'description' => 'Success'
          );
        }
      }

      return array(
        'status'      => false,
        'description' => 'Superuser does not exits!'
      );
    }

    return array(
      'status'      => false,
      'description' => 'Wrong configuration'
    );
  }


  /** 
   * Auto Login Main Function
   * 
   * Here we verify active session
   * of the logged in user. Verification may use DB
   * look up but we only update cookie salt in DB
   * on auto login function
   * 
   * If user session is not valid, we delete
   * the session and logout the user */
  function verify_session(){
    $verification_result = parent::verify_php_session();

    /**
     * Auto login case 1
     * 
     * PHP Session Not Found.
     * 
     * User might be trying to access once his/her session
     * expires due to some reason
     * 
     * based on selection - if they checked remember me
     * option then cookie must be validated and user
     * must be logged in.
     *    -> If they have selected unique session
     *       then browser agent must be validated
     *       before login
     */
    if('SESSION NOT FOUND' == $verification_result['status']){
      $cookie_data = parent::get_cookie();

      // If cookie is not set or does not exits return false 
      if(!isset($cookie_data) || !is_array($cookie_data)) return false;

      // Super User Session Management
      if('json_db' == $this->db_type && 'SU' == $this->table_name) {
        $user_db = new CYZ_JDB(STAG_CONTAINER_DIR.'/jdb/');

        $user_db->db_init('su');

        // get all super user data
        $users_data = $user_db->get_table($this->table_name);
      }

      // Verify Cookie
      $validation = parent::verify_cookie_session($cookie_data, $users_data);

      // var_dump($validation);

      if('VALID' == $validation['status']){
        // As cookie is valid
        // We can get user ID from cookie
        $user_id = cyz_base64_decode($cookie_data[0]);

        // Get password from cookie
        $password = $cookie_data[1];

        // Get remember flag from cookie
        if('30DAYS' == $cookie_data[5]) $remember = true;
        else $remember = false;

        // Create new super user session
        parent::create_session($user_id, $password, $remember);

        /**
         * Update DB with session salt */
        $user_db->update_column_data(
          $this->table_name,
          $validation['key'],
          $this->db_salt,
          parent::get_cookie_salt()
        );
  
        // Close DB connection
        $user_db = null;

        return true;
      }
    }

    /**
     * Auto login case 2
     * 
     * PHP Session is valid */
    else if('VALID' == $verification_result['status']){
      $user_id = $verification_result['user_id'];

      // Super User Session Management
      if('json_db' == $this->db_type && 'SU' == $this->table_name) {
        $user_db = new CYZ_JDB(STAG_CONTAINER_DIR.'/jdb/');

        $user_db->db_init('su');

        // get all super user data
        $users_data = $user_db->get_table($this->table_name);

        if(empty($users_data)) return false;

        // Loop through user data
        foreach($users_data as $key => $user_data){
          // Get user with user ID
          if(isset($user_data["su_username"]) && $user_id == $user_data["su_username"]){
            if(parent::get_user_agent() != $user_data['su_browser_id']) return false;
          }
        }
      }

      return true;
    }


    /** Logout in case of error */
    return false;
  }

  

  function logout($slug = null){
    // Something went wrong
    if(!defined('SU_ID')) define('SU_ID', null);

    // Delete Session
    parent::delete_session();

    // redirect
    if(isset($slug)) header("Location: ".get_home_url().$slug);
    else header("Location: ".get_home_url());
    exit;
  }
}
