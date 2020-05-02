<?php

/** Get API Routing First */
stag_include_controller('/routing/api.php', 'admin');

// Gateway
stag_define_global_route('/'.ADMIN_PANEL_SLUG.'/', '/views/gateway.php');

// Dashboard
stag_define_global_route('/'.ADMIN_PANEL_SLUG.'/', '/views/admin-panel.php');