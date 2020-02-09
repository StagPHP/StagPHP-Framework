<?php
/**
 * StagPHP Application Deployment Controller
 *
 * @package StagPHP
 */

/** Include form fields */
stag_attach_controller('/form/main.php', 'library');

/** Include session token */
stag_attach_controller('/security/main.php', 'library');
