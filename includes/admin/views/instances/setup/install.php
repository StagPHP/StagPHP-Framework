<?php
/**
 * StagPHP View
 * Contains Setup View Main File
 *
 * @package StagPHP
 */

/** Attach setup controller */
stag_attach_controller('/setup/common.php', 'admin');

/** Attach Install View Header */
stag_insert_template('/templates/general/head.php', 'admin');

/** Check Get Parameter
 *  If setup parameter found than attach different views */
if(isset($_GET['setup'])):

  /** Setup Error View */
  if($_GET['setup'] == 'error'):
  /** Get Welcome View Instance Template */
  stag_insert_template('/instances/setup/body/error.php', 'admin');

  /** Setup Apache htaccess View */
  elseif($_GET['setup'] == 'apache'):
  /** Show DB Setup view after processing post request */
  stag_insert_template('/instances/setup/body/apache-setup.php', 'admin');

  /** Setup Database */
  elseif($_GET['setup'] == 'db'):
  /** Show DB Setup view after processing post request */
  stag_insert_template('/instances/setup/body/mysql-setup.php', 'admin');

  /** Setup Super User Credential */
  elseif($_GET['setup'] == 'su'):
  /** Show DB Setup view after processing post request */
  stag_insert_template('/instances/setup/body/superuser-setup.php', 'admin');

  /** Complete Setup */
  elseif('completed' == $_GET['setup']):
  stag_insert_template('/instances/setup/body/completed.php', 'admin');

  // End If Statement
  endif;

else:
  
  /** Get Welcome View Instance Template */
  stag_insert_template('/instances/setup/body/welcome.php', 'admin');

// End If Statement
endif;

/** Get Footer */
stag_insert_template('/templates/general/footer.php', 'admin');
