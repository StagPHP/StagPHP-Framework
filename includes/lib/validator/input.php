<?php

/** CYZ User Input Validator */
function cyz_input_validate($type, $input){
  // Check if input is empty return false
  if(empty($input)) return [false, 'Field Empty'];

  /** Check if the input characters are valid utf8 characters */
  if(cyz_check_valid_utf8($input)){
    $username = "/(^(^[^\w]|[\_\-])|[^\w])/";
    $db_name = "/(^(^[^\w]|[\_\-])|[^\w\-\$\#])/";
    $phone_number = "/[^\d]/";

    /** Validate Number */
    if($type == 'number'){
      if(floatval($input) == $input) return [true, 'Field is valid'];
    }

    /** Validate Phone Number */
    else if($type == 'phone-number'){
      $formatted = preg_replace($phone_number, "", $input);
      if($formatted == $input) return [true, 'Field is valid'];
    }

    /** Validate Username */
    else if($type == 'username'){
      $formatted = preg_replace($username, "", $input);
      if($formatted == $input) return [true, 'Field is valid'];
    }

    /** Validate Custom Field: Database name */
    else if($type = 'db-name'){
      $formatted = preg_replace($db_name, "", $input);
      if($formatted == $input) return [true, 'Field is valid'];
    }

    /** Validate simple string with all utf8 valid characters */
    else if($type = 'string') return [true, 'Field is valid'];
  }

  /** If validation fails */
  return [false, 'Field not valid'];
}


/** CYZ User Password Validator */
function cyz_password_validate($pass_1, $pass_2, $strength){
  if($strength == null) $strength = array(
    'length-min'  => 8,
    'length-max'  => 64,
    'number'      => 'no',
    'uppercase'   => 'no',
    'lowercase'   => 'no',
    'special'     => 'no'
  );


  if(empty($pass_1) || empty($pass_2))
  return [false, 'One or more fields are empty!'];

  $pass_1 = (string)$pass_1;
  $pass_2 = (string)$pass_2;

  if($pass_1 !== $pass_2)
  return [false, 'Fields does not match!'];

  if(false === cyz_check_valid_utf8($pass_1))
  return [false, 'Fields contain invalid characters!'];

  if(false === cyz_valid_password_characters($pass_1))
  return [false, 'Fields contain invalid characters!'];

  $pass_length = strlen($pass_1);

  if($pass_length < $strength['length-min'])
  return [false, 'Fields must contain at least '.$strength['length-min'].' characters!'];

  if($pass_length > $strength['length-max'])
  return [false, 'Fields must contain at max '.$strength['length-max'].' characters!'];

  // Password Contains Number
  if($strength['number'] == 'yes'){
    if(!preg_match('/\d/', $pass_1))
    return [false, 'Fields must contain at least one number!'];
  }

  // Password Contains Upper Case Letter
  if($strength['uppercase'] == 'yes'){
    if(!preg_match('/[A-Z]/', $pass_1))
    return [false, 'Fields must contain at least one uppercase letter!'];
  }

  // Password Contains Lower Case Letter
  if($strength['lowercase'] == 'yes'){
    if(!preg_match('/[a-z]/', $pass_1))
    return [false, 'Fields must contain at least one lowercase letter!'];
  }

  // Password Contains Special characters Letter
  if($strength['special'] == 'yes'){
    if(!preg_match('/[\w\\\/\ \'\.\`\"^£:;!$%&*(){}[\]@#~?><>,|=+-]/g', $pass_1))
    return [false, 'Fields must contain at least one special character!'];
  }

  return [true, 'Fields are valid!'];
}
