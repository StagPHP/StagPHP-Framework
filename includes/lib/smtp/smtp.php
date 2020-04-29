<?php

class stag_smtp{
  private $from_name;
  private $from_email;
  private $reply_to_name;
  private $reply_to_email;
  private $boundary;
  private $attachment_mime_type;
  private $headers;
  private $body;

  function __construct($data){
    $this->from_name      = SMC_FROM_NAME;
    $this->from_email     = SMC_FROM_EMAIL;
    $this->reply_to_name  = SMC_REPLY_TO_NAME;
    $this->reply_to_email = SMC_REPLY_TO_EMAIL;

    // Md5 hashed value of a random number
    $this->boundary = md5(rand(1111111111,9999999999));
  }

  function send_mail($data){
    $to = $data['to'];
    $subject = $data['subject'];
    $is_html_email = $data['html-email'];

    if($is_html_email){
      $is_html_email = TRUE;
      $message_body = compose_html_email(
        $data['template-loc'],
        $data['template-data']
      );
    } else {
      $is_html_email =  FALSE;
      $message_body = $data['email-body'];
    }

    if(isset($data['attachment-field-name'])) $attachment_type = 'uploaded-file';
    else $attachment_type = 'none';

    $this->compose_email_head();

    $this->compose_email_body($is_html_email, $message_body);

    if('uploaded-file' == $attachment_type){
      $mime_type = 'any';

      if(isset($data['attachment-type']))
      $mime_type = $data['attachment-type'];

      $this->attach_attachment($attachment_field_name, $mime_type);
    }     

    return $this->send_mail_using_php($to, $subject);
  }

  private function compose_email_head(){
    $this->headers = "MIME-Version: 1.0\r\n";
    $this->headers .= "From: ".$this->from_name." <".$this->from_email.">\r\n";
    $this->headers .= "Reply-To: ".$this->reply_to_name." <".$this->reply_to_email.">\r\n";
    $this->headers .= "Content-Type: multipart/mixed; boundary = ".$this->boundary."\r\n";
    $this->headers .= "X-Mailer: PHP/".phpversion();
  }

  private function compose_email_body($is_html_email, $message_body){
    if($is_html_email) $type = 'text/html';
    else $type = 'text/plain';

    $this->body = "--".$this->boundary."\r\n"; 
    $this->body .= "Content-Type: ".$type."; charset=ISO-8859-1\r\n"; 
    $this->body .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
    $this->body .= chunk_split(base64_encode($message_body));
    $this->body .= "--".$this->boundary."\r\n"; 
  }

  private function attach_attachment($field_name, $mime_type){
    $result = $this->get_attachment_content($field_name, $mime_type);

    if($result['status']) {
      $encoded_content = $result['content'];
      $file_name = $result['file-name'];

      $this->body .= "--".$this->boundary."\r\n"; 
      $this->body .="Content-Type: ".$this->attachment_mime_type."; name=".$file_name."\r\n"; 
      $this->body .="Content-Disposition: attachment; filename=".$file_name."\r\n"; 
      $this->body .="Content-Transfer-Encoding: base64\r\n"; 
      $this->body .="X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n";  
      $this->body .= $encoded_content;
      $this->body .= "--".$this->boundary."\r\n";
    }
    else var_dump($result);
  }

  private function get_attachment_content($field_name, $mime_type){
    //Get uploaded file data using $_FILES array 
    $tmp_name = $_FILES[$field_name]['tmp_name'];   // get the temporary file name of the file on the server 
    $name	    = $_FILES[$field_name]['name'];       // get the name of the file 
    $size	    = $_FILES[$field_name]['size'];       // get size of the file for size validation 
    $type	    = $_FILES[$field_name]['type'];       // get type of the file 
    $upload_error	  = $_FILES[$field_name]['error'];      // get the error (if any)

    if($upload_error === UPLOAD_ERR_OK){
      $actual_mime_type = $this->get_uploaded_attachment_mime($tmp_name);

      if($mime_type == $actual_mime_type || 'any' == $mime_type){
        $handle = @fopen($tmp_name, "r");
        $content = @fread($handle, $size);
        @fclose($handle);

        return array(
          'status'    => TRUE,
          'file-name' => $name,
          'content'   => chunk_split(base64_encode($content))
        );
      }

      return array(
        'status'      => FALSE,
        'Description' => 'Mime Type Not Correct!'
      );
    }

    return array(
      'status'      => FALSE,
      'Description' => 'Upload failed!'
    );
  }

  private function get_uploaded_attachment_mime($temp_uploaded_file){
    if (function_exists('finfo_open')) {
    /** Getting correct $_FILES mime value using finfo function */
      $finfo = finfo_open(FILEINFO_MIME_TYPE);

      /** Getting file Info */
      $this->attachment_mime_type = finfo_file($finfo, $temp_uploaded_file);

      /** Close File Info */
      finfo_close($finfo);
    }
    
    /** Set MIME type */
    else $this->attachment_mime_type = mime_content_type($temp_uploaded_file);
    

    /** Get file type and extension array */
    $file_type_array = explode('/', $this->attachment_mime_type);

    /** Return MIME type category */
    return $file_type_array[0];
  }

  private function compose_html_email($html_template_loc, $data_set){
    /** Get Template Content */
    $html_template_content = file_get_contents($html_template_loc);

    /** Get Content Variable And Substitute */
    foreach($data_set as $key => $value)
    $html_template_content = preg_replace("/((\{\{)".$key."(\}\}))/m", $value, $template_text);

    // Return HTML template Content
    return chunk_split(base64_encode($html_template_content));
  }
}