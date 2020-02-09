<?php

function cyz_check_valid_utf8($string){
  if(empty($string)){
    return true;
  }

  if(0 === strlen($string)){
    return false;
  }

  if(0 ===  preg_match('//u', $string)){
    return false;
  }

  if(false === mb_check_encoding($string, 'UTF-8')){
    return false;
  }

  if(false === mb_detect_encoding($string, 'UTF-8', true)){
    return false;
  }

  return true;
}

function cyz_valid_password_characters($string){
  $allowed_characters = "/[\w\/\\\ \'\.\`\"^£:;!$%&*(){}[\]@#~?><>,|=+-]/";

  $formatted = preg_replace($allowed_characters, "", $string);

  if(empty($formatted)) return true;
  else return false;
}
