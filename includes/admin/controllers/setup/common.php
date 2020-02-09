<?php

/** Include session cache */
stag_attach_controller('/core/session-cache.php', 'components');

/** Include form fields */
stag_attach_controller('/form/main.php', 'library');

/** Include session token */
stag_attach_controller('/security/main.php', 'library');

/** Include validator to validate input */
stag_attach_controller('/validator/input.php', 'library');

/** Include validator to validate character set */
stag_attach_controller('/validator/character.php', 'library');

/** Include URL Fetcher to fetch URLs */
stag_attach_controller('/file-manager/file-manager.php', 'library');

GLOBAL $APP_404;
$APP_404 = FALSE;