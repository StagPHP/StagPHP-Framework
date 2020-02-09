<?php

/** Include Apache HTACCESS setup file */
stag_attach_controller('/app-deploy/upload.php', 'ajax', true);

ini_set('upload_max_filesize', '60M');     
ini_set('max_execution_time', '999');
ini_set('memory_limit', '128M');
ini_set('post_max_size', '60M'); 

global $form_status;

if(true === $form_status['status']) echo json_encode(array(
  'result' => 'successful'
));

else echo json_encode(array(
  'result'    => 'failed',
  'response'  => $form_status['description']
));
