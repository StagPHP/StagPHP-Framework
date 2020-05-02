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
  '/' => array(
    'instance' => '/admin-panel/dashboard.php'
  ),
  '/deploy-app/' => array(
    'instance' => '/admin-panel/application/deploy-app.php'
  ),
  '/stagons/' => array(
    'instance' => '/admin-panel/stagons/all-stagons.php'
  ),
  '/add-stagon/' => array(
    'instance' => '/admin-panel/stagons/add-stagon.php'
  ),
  '/all-users/' => array(
    'instance' => '/admin-panel/profile/all-users.php'
  ),
  '/profile/' => array(
    'instance' => '/admin-panel/profile/profile.php'
  ),
  '/update/' => array(
    'instance' => '/admin-panel/management/updates.php'
  ),
);

// =============================================
// Controllers
// =============================================

stag_attach_controller('/admin-panel.php');

/** Include Instance Specific Controller */
stag_attach_controller_based_on_path($instance_data);

// =============================================
// Templates
// =============================================

/** Attaching: HTML Head */
stag_attach_template('/templates/general/header.php');

/** Attaching: Header */
stag_attach_template('/templates/admin-panel/display-header.php');

/** Attaching: Opening Body */
stag_attach_template('/templates/admin-panel/body-opening.php');

/** Attaching: Body */
stag_attach_instance_based_on_path($instance_data);

/** Attaching: Closing Body */
stag_attach_template('/templates/admin-panel/body-closing.php');

/** Attaching: Actual Footer */
stag_attach_template('/templates/general/footer.php');