<?php


/** Include Apache HTACCESS setup file */
stag_attach_controller('/gateway/login.php', 'admin');


/** Attach Install View Header */
stag_insert_template('/templates/general/head.php', 'admin');


/** Get Welcome View Instance Template */
stag_insert_template('/instances/gateway/body/login.php', 'admin');


/** Get Footer */
stag_insert_template('/templates/general/footer.php', 'admin');
