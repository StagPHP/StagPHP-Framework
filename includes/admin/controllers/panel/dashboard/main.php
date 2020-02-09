<?php

if(isset($_GET['enable-maintenance-mode']) && 'yes' == $_GET['enable-maintenance-mode']){
  initiate_update_app_sandbox();
} else {
  // // Unlink Update File
  // if(file_exists(ABSPATH.'/update.php')) {
  //   echo ' File Deleted ';
  //   unlink(ABSPATH.'/update.php');
  // }
}
