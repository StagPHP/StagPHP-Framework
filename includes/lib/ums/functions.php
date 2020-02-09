<?php

/** User Management System core functionalities */
class stag_ums_base{

  /** User ID */
  private $user_id;

  /** User IP */
  private $user_ip;

  /** User's browser identity */
  private $browser_id;

  /** Session Cookie Variable name */
  private $cookie_name = 'CYZ_SU_CRED';

  /** Session Cookie Salt */
  private $cookie_salt;


  /** PHP Session Variable */
  private $session_variable = 'CYZ_SU_CRED';


  /** Base Constructor Function */
  function __construct(){
    // Set IP
    $this->user_ip = $this->get_ip();

    // Set SU Agent
    $this->browser_id = cyz_base64_encode($_SERVER['HTTP_USER_AGENT']);
  }


  /** Get user IP address */
  private function get_ip(){
    if (     getenv('HTTP_CLIENT_IP')       ) return getenv('HTTP_CLIENT_IP');
    else if( getenv('HTTP_X_FORWARDED_FOR') ) return getenv('HTTP_X_FORWARDED_FOR');
    else if( getenv('HTTP_X_FORWARDED')     ) return getenv('HTTP_X_FORWARDED');
    else if( getenv('HTTP_FORWARDED_FOR')   ) return getenv('HTTP_FORWARDED_FOR');
    else if( getenv('HTTP_FORWARDED')       ) return getenv('HTTP_FORWARDED');
    else if( getenv('REMOTE_ADDR')          ) return getenv('REMOTE_ADDR');
    return 'UNKNOWN';
  }


  /** Set Cookie Salt */
  private function set_cookie_salt(){
    /** Encoded time as cookie salt */
    $this->cookie_salt = cyz_base64_encode('cyz_session_salt'.time());
  }


  /** Create cookie for first time */
  private function create_cookie($value, $remember){

    /** If remember me flag is true than set cookie for 30 days
     *  else set it fot five minute */
    if(true === $remember) $cookie_time = time() + 2592000;
    else $cookie_time = 0;

    // Set Domain
    $domain = $_SERVER['HTTP_HOST'];

    // Set cookie as secure
    $secure = (isset($_SERVER['HTTPS']) ? 1 : 0);
    
    // Create Cookie
    setcookie($this->cookie_name, $value, $cookie_time, "/", $domain, $secure);
  }


  /** Delete cookie on session exit */
  private function delete_cookie(){  
    // Check cookie exists return null if does not
    if(!isset($_COOKIE[$this->cookie_name])) return null;

    // Set Cookie Expiry to past
    $cookie_time = time() - 3600;

    // Set Domain
    $domain = $_SERVER['HTTP_HOST'];

    // Set cookie as secure
    $secure = (isset($_SERVER['HTTPS']) ? 1 : 0);

    // Create Cookie
    setcookie($this->cookie_name, '', $cookie_time, "/", $domain, $secure);
  }


  /** Get Cookie Data */
  function get_cookie(){
    /**
     * check cookie exits and
     * return cookie data in array */
    if(isset($_COOKIE[$this->cookie_name])) return explode('&&', $_COOKIE[$this->cookie_name]);

    /** Return false in case of error */
    return false;
  }


  /** Get Cookie Salt */
  function get_cookie_salt(){
    return $this->cookie_salt;
  }


  /** Get Agent */
  function get_user_agent(){
    return $this->browser_id;
  }


  /** Get IP */
  function get_user_ip(){
    return cyz_base64_encode($this->user_ip);
  }


  /** Update session IP in  PHP Session */
  function update_ip_php_session(){
    // Get PHP Session DATA
    $session_data = $_SESSION[$this->session_variable];

    // Phrase Session data - Set it into sda AKA Session Data Array
    $sda = explode('&&', $session_data);

    // Create new Session DATA
    $new_session_data = $sda[0].'&&'.$this->user_ip.'&&'.$sda[2];

    // Set new session data
    $_SESSION['CYZ_SU_CRED'] = $new_session_data;

    // Regenerate Session
    session_regenerate_id();
  }


  /** PHP Session Verification */
  function verify_php_session(){
    // Start PHP Session
    if(session_status() == PHP_SESSION_NONE) session_start();

    // Check PHP Session Data
    if(empty($_SESSION[$this->session_variable])) return array(
      'status'  => 'SESSION NOT FOUND',
      'user_id' => null
    );

    // Get PHP Session DATA
    $session_data = $_SESSION[$this->session_variable];

    // Phrase Session data
    $session_data_array = explode('&&', $session_data);

    // Return false if user agent (Browser Spec) does not match
    if($this->browser_id != $session_data_array[0]) return array(
      'status'  => 'AGENT CHANGED',
      'user_id' => null
    );

    // Check if IP has changed
    if($this->user_ip != $session_data_array[1]) return array(
      'status'  => 'IP CHANGED',
      'user_id' => null
    );

    /** Return false if cookie does not exits */
    if(false ===  $this->get_cookie()) return array(
      'status'  => 'AUTH COOKIE NOT FOUND',
      'user_id' => null
    );

    // Return user id
    return array(
      'status'  => 'VALID',
      'user_id' => $session_data_array[2]
    );
  }


  /** Cookie Session Verification */
  function verify_cookie_session($cookie_data, $users_data){
    if(6 != count($cookie_data)) return array(
      'status' => 'COOKIE DATA NOT VALID',
      'key'    => null
    );

    // Get user ID from cookie
    $user_id = cyz_base64_decode($cookie_data[0]);

    // Get password from cookie
    $password = $cookie_data[1];

    // Get Cookie Salt
    $salt = $cookie_data[2];

    // Get Cookie Salt
    $ip = $cookie_data[3];

    // Get Cookie Salt
    $agent = $cookie_data[4];

    // Loop through user data
    foreach((array)$users_data as $key => $user_data){

      // Get user with user ID
      if($user_id == $user_data['su_username']){

        // Check password
        if($password != md5($user_data['su_password'])) return array(
          'status' => 'PASSWORD NOT MATCH',
          'key'    => null
        );

        // Check session salt
        else if($salt != $user_data['su_login_salt']) return array(
          'status' => 'SALT NOT MATCH',
          'key'    => null
        );

        // Check session salt
        else if($ip != $user_data['su_ip']) return array(
          'status' => 'IP NOT MATCH',
          'key'    => null
        );

        // Check session salt
        else if($agent != $user_data['su_browser_id']) return array(
          'status' => 'AGENT NOT MATCH',
          'key'    => null
        );

        // Cookie is valid
        return array(
          'status' => 'VALID',
          'key'    => $key
        );
      }
    }

    // User not found or some other error
    return array(
      'status' => 'ERROR',
      'key'    => null
    );;
  }


  /** Create New Session */
  function create_session($username, $password, $remember){
    // Set Super Encoded User Name and SU ID
    $this->user_id = cyz_base64_encode($username);

    // Set Password
    $this->su_pass =$password;

    // Set Remember Flag
    $remember = ($remember ? true : false);

    // Set Cookie Salt
    $this->set_cookie_salt();

    // Set cookie expiry data
    if($remember) $end_of_cookie = '30DAYS';
    else $end_of_cookie = 'TEMP';
    
    // Set cookie data
    $cookie_val = $this->user_id.'&&'.
                  $this->su_pass.'&&'.
                  $this->cookie_salt.'&&'.
                  cyz_base64_encode($this->user_ip).'&&'.
                  $this->browser_id.'&&'.
                  $end_of_cookie;

    // Create Cookie
    $this->create_cookie($cookie_val, $remember);

    // Start PHP Session
    if(session_status() == PHP_SESSION_NONE) session_start();

    // Save Session Data in PHP Session
    $_SESSION[$this->session_variable] = $this->browser_id.'&&'.$this->user_ip.'&&'.$this->user_id;

    return session_id();
  }


  /** Delete Session */
  function delete_session(){
    // Delete SU CRED cookie created
    $this->delete_cookie();

    // Start PHP Session
    if(session_status() == PHP_SESSION_NONE) session_start();

    // Empty session variable
    $_SESSION[$this->session_variable] = null;
  }

/** END: User Session Management Class */
}
