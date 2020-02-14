<?php


/** Include Apache HTACCESS setup file */
stag_attach_controller('/gateway/session-verify.php', 'admin');


/** Include Apache HTACCESS setup file */
stag_attach_controller('/panel/stagons/main.php', 'admin');


/** Attaching HTML Head */
stag_insert_template('/templates/general/head.php', 'admin');


/** Attaching Header */
stag_insert_template('/templates/su-panel/header.php', 'admin'); ?>


<div class="content-base">


  <!-- Attach SU Panel Navigation -->
  <?php stag_insert_template('/templates/su-panel/nav.php', 'admin'); ?>
  

  <!-- Attach SU Panel Body -->
  <?php stag_insert_template('/instances/panel/stagons/body.php', 'admin'); ?>


</div>


<!-- Attaching Sub Footer -->
<?php stag_insert_template('/templates/su-panel/sub-footer.php', 'admin'); ?>


<!-- Attaching HTML Footer -->
<?php stag_insert_template('/templates/general/footer.php', 'admin'); ?>