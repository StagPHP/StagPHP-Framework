<?php

// Ajax Core update
stag_define_direct_route('/'.ADMIN_PANEL_SLUG.'/api/internal/core-update/', '/api/core-update.php', TRUE);

// AJAX
stag_define_direct_route('/'.ADMIN_PANEL_SLUG.'/api/internal/upload-application-package/', '/api/upload-application-package.php', TRUE);

// AJAX Get Static View
stag_define_direct_route('/'.ADMIN_PANEL_SLUG.'/api/internal/get-static-view-list/', '/api/get-static-view-list.php', TRUE);

// AJAX Get StagONS List
stag_define_direct_route('/'.ADMIN_PANEL_SLUG.'/api/internal/stagons/', '/api/stagons.php', TRUE);

// AJAX Code Edit Static View
stag_define_direct_route('/'.ADMIN_PANEL_SLUG.'/api/internal/get-view-instance-code/', '/api/get-view-instance-code.php', TRUE);

// REST API EP - Fetch JDB Tables
stag_define_direct_route('/'.ADMIN_PANEL_SLUG.'/api/internal/get-jdb-tables/', '/api/get-jdb-tables.php', TRUE);

// Gateway
stag_define_global_route('/'.ADMIN_PANEL_SLUG.'/', '/views/gateway.php');

// Dashboard
stag_define_global_route('/'.ADMIN_PANEL_SLUG.'/', '/views/admin-panel.php');