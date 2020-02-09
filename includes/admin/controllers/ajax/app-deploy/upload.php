<?php
/**
 * AJAX Endpoint
 * StagPHP Application Deployment
 *
 * @package StagPHP
 */


/** Include form fields */
stag_attach_controller('/form/main.php', 'library');

/** Include session token */
stag_attach_controller('/security/main.php', 'library');

/** Include URL Fetcher to fetch URLs */
stag_attach_controller('/file-upload/main.php', 'library');


/** Form Name - Used to identify form */
$form = 'app_deployment_form';

/** Form Action - Used to avoid identify form action and avoid conflict */
$form_action = 'app_deployment';

// Stores form status
$form_status = array();
global $form_status;

/** Process the POST request submitted using form after
 *  session token verification */
if(verify_ajax_token($form, $form_action)):

  $cyz_upload = new cyz_upload($_FILES['file']);

  $upload_arg = array(
    'file-type-allowed'  => 'application',
    'extensions-allowed' => 'zip',
    'save-as'            => 'cyz-app',
    'save-location'      => '/cyz-gen/app-deployment/'
  );

  $form_status = $cyz_upload->upload_file($upload_arg);

/** Close if statement */
endif;
