<?php
/**
 * StagPHP Super User Setup File
 * Contains Apache Predefined Settings
 *
 * @package StagPHP
 */


/** Include URL Fetcher to fetch URLs */
stag_attach_controller('/jdb/JDB.php', 'library');

function save_su_credentials($su_username, $su_email, $su_password){
  /** File Operator Object */
  $file_worker = new stag_file_manager('/');

  $file_worker->create_directory(array(
    'directory' => '/container/'
  ));

  $su_db = new CYZ_JDB(STAG_CONTAINER_DIR.'/jdb/');

  $su_db->db_init('su');

  // Set Table Name
  $table_name = 'SU';

  // Create Table
  $su_db->add_table($table_name);

  // get all super user data
  $sus = $su_db->get_table($table_name);

  foreach((array)$sus as $key => $su_data){
    if($su_username == $su_data['su_username']) return [
      'status' => false,
      'description' => 'User Already Exists'
    ];
  }

  // New User
  $new_user = array(
    'su_username' => $su_username,
    'su_email' => $su_email,
    'su_password' => md5($su_password)
  );

  $updated = $su_db->add_row($table_name, $new_user);

  if($updated) return [
    'status' => true,
    'description' => 'success'
  ];

  else return [
    'status' => false,
    'description' => 'Error Saving User Credential'
  ];
}



/** Form Name - Used to identify form*/
$form = 'su_setup_form';

/** Form Action - Used to avoid action conflict */
$form_action = 'su_setup';

/** Store error while processing form */
$form_error = array();

/** Process the POST request submitted using form after
 *  session token verification */
if(verify_form_token($form, $form_action)):

  /** Validate: Superuser username */ 
  $valid = cyz_input_validate('username', $_POST['su-username']);
  /** If valid store the username */
  if($valid[0]) $su_username = $_POST['su-username'];
  /** If not valid then push the error to form error */
  else array_push($form_error, 'Superuser ID: '.$valid[1]);

  /** Validate: Superuser email */ 
  $valid = cyz_input_validate('email', $_POST['su-email']);
  /** If valid store the email */
  if($valid[0]) $su_email = $_POST['su-email'];
  /** If not valid then push the error to form error */
  else array_push($form_error, 'Superuser Email: '.$valid[1]);

  /** Validate: name of the database password */ 
  $valid = cyz_password_validate($_POST['su-password'], $_POST['su-confirm-password'], null);
  /** If valid store the database password */
  if($valid[0]) $su_password = $_POST['su-password'];
  /** If not valid then push the error to form error */
  else array_push($form_error, 'Superuser Password: '.$valid[1]);

  if($su_username && $su_password){
    // $su_config = cyz_setup_su_config($su_username, $su_password);
    $su_saved = save_su_credentials($su_username, $su_email, $su_password);

    if(false === $su_saved['status'])
    array_push($form_error, 'Unexpected: '.$su_config['description']);
  }

  /** Return form error */
  if(count($form_error) > 0){
    $error = base64_encode(serialize($form_error));
    
    // Redirect to error instance URL
    header("Location: ".get_home_url().'?setup=error&desc='.$error.'&url=su');
    exit;
  }else{
    /** Redirect to Superuser Dashboard */
    header("Location: ".get_home_url().'/?setup=final-step');
    exit;
  }

/** Close if statement */
endif;
