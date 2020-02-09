<?php

class cyz_upload{
  private $file;

  function __construct($file){
    if(empty($this->file)) $this->file = $file;
  }

  // Arguments Required
  // File Name
  // File Type
  // Temporary File Location
  // Save-as New Name
  // Extensions Allowed
  // File Upload Directory
  function upload_file($data){
    // Get Data
    $file_name          = $this->file['name'];
    $file_type          = $this->file['type'];
    $temp_file          = $this->file['tmp_name'];
    $upload_error       = $this->file['error'];
    $file_type_allowed  = $data['file-type-allowed'];
    $extensions_allowed = $data['extensions-allowed'];
    $save_as            = $data['save-as'];
    $save_location      = $data['save-location'];

    
  
    // Create Response Variable
    $response = array();

    // Check Upload Error
    $upload_error = $this->get_upload_error($upload_error);
    if($upload_error !== 'No Error') {
      $response['status'] = false;
      $response['description'] = $upload_error;
      return $response;
    }

    // Get Real File Type [Un Altered]
    $file_type_real = $this->get_file_info($temp_file);
    

    // Cross Check File Type
    if($file_type == $file_type_real['file-type'].'/'.$file_type_real['file-extension']){
      if($file_type_real['file-type'] == $file_type_allowed){
        // Check extension is allowed
        // Convert CSV to array
        $extensions_allowed = explode(',',$extensions_allowed);
        if(!in_array($file_type_real['file-extension'], $extensions_allowed)) {
          $response['status'] = false;
          $response['description'] = 'File extension not allowed';
          return $response;
        }


        // File Details
        if(empty($save_as)) $save_as = $this->get_safe_file_name($file_name);
        $file_extension ='.'.$file_type_real['file-extension'];

        // Save File
        $saved_file = $this->save_file(array(
          'file-name'        => $save_as,
          'temp-file'        => $temp_file,
          'file-extension'   => $file_extension,
          'upload-directory' => $save_location
        ));

        // The Final File Location
        $final_file_loc = ABSPATH.$save_location.'/'.$saved_file;

        if($final_file_loc){
          $response['status'] = true;
          $response['description'] = $final_file_loc;
          return $response;
        }else{
          $response['status'] = false;
          $response['description'] = 'Unable to save file!';
          return $response;
        }
      }else{
        $response['status'] = false;
        $response['description'] = 'File type cannot be recognised';
        return $response;
      }
    }else{
      $response['status'] = false;
      $response['description'] = 'Invalid File Type';
      return $response;
    }
  }


  // Get upload errors
  private function get_upload_error($file_error){
    if($file_error === UPLOAD_ERR_OK){
      return 'No Error';
    }else{
      switch ($file_error) { 
        case UPLOAD_ERR_INI_SIZE: 
          $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
          break;

        case UPLOAD_ERR_FORM_SIZE: 
          $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
          break;

        case UPLOAD_ERR_PARTIAL: 
          $message = "The uploaded file was only partially uploaded"; 
          break;

        case UPLOAD_ERR_NO_FILE: 
          $message = "No file was uploaded"; 
          break;

        case UPLOAD_ERR_NO_TMP_DIR: 
          $message = "Missing a temporary folder"; 
          break;

        case UPLOAD_ERR_CANT_WRITE: 
          $message = "Failed to write file to disk"; 
          break;

        case UPLOAD_ERR_EXTENSION: 
          $message = "File upload stopped by extension"; 
          break;

        default: 
          $message = "Unknown upload error"; 
          break; 
      }
      return $message;
    }
  }


  // Get File Info
  private function get_file_info($temp_file){
    // DO NOT TRUST $_FILES mime VALUE !!
    // Check MIME Type by yourself
    $file_info = new finfo(FILEINFO_MIME_TYPE);
    $file_type = $file_info->file($temp_file);

    // Get file type and extension array
    $file_type_array = explode('/',$file_type);

    return array(
      'file-type'       => $file_type_array[0],
      'file-extension'  => $file_type_array[1],
    );
  }


  // Get Safe File Name
  private function get_safe_file_name($file_name){
    $file_name = explode('.',$file_name);
    $file_name = array_pop($file_name);
    $file_name = implode("-",$file_name);
    $file_name = str_replace(' ','-',$file_name);

    // Remove All Special Character
    $file_name = preg_replace('/[^A-Za-z0-9\-]/', '', $file_name);
    
    return strtolower($file_name);
  }


  private function select_file_type($file_type){
    $file_name = explode('.',$file_name);
    $file_extension = strtolower(end($file_name));
  
    if($file_extension == 'jpg'){
      $file_name = array_pop($file_name);
      $file_name = implode('.',$file_name);
      return $file_name.'.jpeg';
    }
  }

  // Make directory if does not exists
  private function make_directory($dir){  
    // Create Directory if does not exists
    if(!is_dir(ABSPATH.$dir)) mkdir(ABSPATH.$dir, 0777, true);

    // Check Directory
    if(is_dir(ABSPATH.$dir)) return ABSPATH.$dir;
    else return false;
  }


  // Arguments Required
  // File Name
  // Temporary File Location
  // File Extension
  // File Upload Directory
  private function save_file($data){
    $file_name = $data['file-name'];
    $temp_file = $data['temp-file'];
    $file_extension = $data['file-extension'];
    $upload_sub_directory = $data['upload-directory'];

    // Get Full Upload Directory
    $upload_directory = $this->make_directory($upload_sub_directory);

    if($upload_directory) {
      $final_file = $upload_directory.$file_name.$file_extension;

      // $file_count = "";

      // if(file_exists($final_file)){
      //   $file_count = 0;
      //   do {
      //     $file_count++;
      //     $final_file = $upload_directory.$file_name.'-'.$file_count.$file_extension;
      //   }
      //   while(file_exists($final_file));
      // }

      $upload_status = move_uploaded_file($temp_file, $final_file);

      if($upload_status) return true;
    }

    return false;
  }
}
