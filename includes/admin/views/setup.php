<?php
/**
 * Name:        Setup View Instance
 * Description: This is StagPHP setup view instance
 * 
 * @package:    StagPHP Core File
 */

/** General controller collection */
stag_attach_controller('/setup/general.php');

/** General HTML head */
stag_attach_template('/templates/general/header.php');

/** Check Get Parameter
 *  If setup parameter found than attach different views */
if (isset($_GET['setup'])) {

  /** Setup Error View */
  if ($_GET['setup'] == 'error') {
    /** Get Welcome View Instance Template */
    stag_attach_template('/setup/error.php');
  }
  

  /** Setup Apache htaccess View */
  else if ($_GET['setup'] == 'model-selection') {
    /** Include SU Setup script 
    * SU Script Process POST request
    * on form submit - during installation */
    stag_attach_controller('/setup/model-selection/main.php');

    /** Show DB Setup view after processing post request */
    stag_attach_template('/setup/model-selection.php');
  }


  /** Setup Apache htaccess View */
  else if ($_GET['setup'] == 'apache') {
    /** Show DB Setup view after processing post request */
    stag_attach_template('/setup/apache-setup.php');
  }
  

  /** Setup Database */
  elseif ($_GET['setup'] == 'db') {
    /** Show DB Setup view after processing post request */
    stag_attach_template('/setup/mysql-setup.php');
  }
  

  /** Setup Super User Credential */
  else if($_GET['setup'] == 'su') {
    /** Show DB Setup view after processing post request */
    stag_attach_template('/setup/superuser-setup.php');
  }
  

  /** Setup Super User Credential */
  else if ($_GET['setup'] == 'final-step') {
    /** Show DB Setup view after processing post request */
    stag_attach_template('/setup/final-step.php');
  }
  

  /** Complete Setup */
  else if ('completed' == $_GET['setup']) {
    stag_attach_template('/setup/completed.php');
  }
}

else {
  /** Include SU Setup script 
  * SU Script Process POST request
  * on form submit - during installation */
  stag_attach_controller('/setup/setup-initiation/main.php');

  /** Get Welcome View Instance Template */
  stag_attach_template('/setup/welcome.php');
}

/** Get Footer */
stag_attach_template('/templates/general/footer.php');