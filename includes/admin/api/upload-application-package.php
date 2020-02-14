<?php

ini_set('upload_max_filesize', '60M');     
ini_set('max_execution_time', '999');
ini_set('memory_limit', '128M');
ini_set('post_max_size', '60M'); 

/** API response template */
stag_attach_controller('/functions/response-template.php', 'admin-api');

/** Secure internal api functions */
stag_attach_controller('/functions/secure-request-internal.php', 'admin-api');

/** Include session token */
stag_attach_controller('/security/main.php', 'library');

/** Include URL Fetcher to fetch URLs */
stag_attach_controller('/file-upload/main.php', 'library');

/** Upload instance */
$cyz_upload = new cyz_upload($_FILES['file']);

/** Upload argument */
$upload_arg = array(
  'file-type-allowed'  => 'application',
  'extensions-allowed' => 'zip',
  'save-as'            => 'cyz-app',
  'save-location'      => '/cyz-gen/app-deployment/'
);

/** Uploading */
$result = $cyz_upload->upload_file($upload_arg);

/** Success */
if(true === $result['status']) success_response(array(
    'description'   => 'Application uploaded successfully!',
    'result'        => array(
        'response'      => TRUE
    )
));

/** Error */
else error_response(array(
    'description'   => 'Application upload failed: '.$result['description']
));
