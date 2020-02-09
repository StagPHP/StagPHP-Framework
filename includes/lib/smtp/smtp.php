<?php
/**
 * StagPHP SMTP: Standalone SMTP Plugin For PHP Applications
 * 
 * Base Configuration file
 *
 * @link https://stagphp.dev
 * @package StagPHP_plugin
 */

/** If you are not using composer - than comment this out */
// namespace smtp;


class cyz_smtp{
  private $from_name;
  private $from_email;
  private $template_dir;
  private $method;
  private $api;



  function __construct($from_name, $from_email, $template_dir = null, $method = null, $api = null){
    /** If Directory location is not provided */
    if(empty($template_dir)) $template_dir = __DIR__.'/email-templates';

    /** 
     * Removing trailing forward slash - if it
     * has any */
    if(substr($template_dir, -1) == '/') $template_dir = rtrim($template_dir, '/');
    
    /** Remove any file with directory name */     
    if(file_exists($template_dir)) @unlink($template_dir);
    
    /** Create Directory if does not exists */
    if(!is_dir($template_dir)) @mkdir($template_dir);

    /** Define JDB Directory Location */
    $this->template_dir = $template_dir;

    /** If from name is empty */
    if(empty($from_name)) $this->from_name = "test";
    $this->from_name = $from_name;

    /**   If from email is empty */
    if(empty($from_email)) $this->from_email = "test@webenfolds.com";
    $this->from_email = $from_email;

    if(strcasecmp('SendGrid', $method) == 0) $this->method = 'SendGrid';
    else $this->method = 'php';

    $this->api = $api;
  }



  private function get_sg_opt_data($to, $subject, $template_text){
    return '{"personalizations":[{
      "to":[{
        "email":'.json_encode($to).'
      }]}],
      "from":{
         "email":'.json_encode($this->from_email).',
         "name":'.json_encode($this->from_name).'
      },
      "subject":'.json_encode($subject).',
      "content":[
      {
        "type":"text/html",
        "value":'.json_encode($template_text).'
      }
    ]}';
  }



  private function send_email_using_sg($email_data){
    // Send Grid CURL Request URL
    $api_request_url = 'https://api.sendgrid.com/v3/mail/send';

    // Curl Request Initialization
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_request_url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $email_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length: '        . strlen($email_data),
      'Authorization: Bearer '  .$this->api
    ));
    $response     = curl_exec($ch);
    $status_code  = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
    curl_close ($ch);

    if(201 != $status_code) return false;
    else return true;
  }

  

  function send_email($to, $subject, $data_set, $template_name){
    if(empty($to) && empty($subject)) return false;

    // Get Template
    $template_text = file_get_contents($this->template_dir.'/'.$template_name);

    /** Get Content Variable And Substitute */
    foreach($data_set as $key => $value){
      $template_text = preg_replace("/((\{\{)".$key."(\}\}))/m", $value, $template_text);
    }

    if('SendGrid' == $this->method){
      if(empty($this->api)) return false;

      $email_data = $this->get_sg_opt_data($to, $subject, $template_text);

      $this->send_email_using_sg($email_data);
    }

    else {
      $headers = "From: $this->from_email $this->from_name" . "\r\n" .

      mail($to, $subject, $template_text);
    }
  }
}
