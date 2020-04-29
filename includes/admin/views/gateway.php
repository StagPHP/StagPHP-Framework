<?php
/**
 * Admin Panel View
 * 
 * @package: StagPHP Core File
 */

/** CYZ VR: View Resources */
$resource_dir = get_assets_dir_uri(NULL, TRUE);

/** Defining Instances */
$instance_data = array(
  '/login/' => array(
    'controller' => '/gateway/login.php',
    'instance' => '/gateway/login.php'
  ),
  '/logout/' => array(
    'controller' => '/gateway/logout.php'
  ),
);


// =============================================
// Controllers
// =============================================

// /** Include Instance Specific Controller */
stag_attach_controller_based_on_path($instance_data);


// =============================================
// Templates
// =============================================

/** Attaching: HTML Head */
stag_attach_template('/templates/general/header.php');

// /** Attaching: Body */
stag_attach_instance_based_on_path($instance_data);

// /** Attaching: Actual Footer */
stag_attach_template('/templates/general/footer.php');