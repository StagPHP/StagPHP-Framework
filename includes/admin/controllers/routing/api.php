<?php 

// Ajax Core update
stag_define_direct_route('/'.ADMIN_PANEL_SLUG.'/api/internal/core-update/', '/api/core-update.php', TRUE);

// AJAX
stag_define_direct_route('/'.ADMIN_PANEL_SLUG.'/api/internal/deploy-app/', '/api/deploy-app.php', TRUE);

// AJAX Get Static View
stag_define_direct_route('/'.ADMIN_PANEL_SLUG.'/api/internal/get-static-view-list/', '/api/get-static-view-list.php', TRUE);

// AJAX Get StagONS List
stag_define_direct_route('/'.ADMIN_PANEL_SLUG.'/api/internal/stagons/', '/api/stagons.php', TRUE);
stag_define_direct_route('/'.ADMIN_PANEL_SLUG.'/api/internal/stagon-add/', '/api/stagon-add.php', TRUE);

// AJAX Code Edit Static View
stag_define_direct_route('/'.ADMIN_PANEL_SLUG.'/api/internal/get-view-instance-code/', '/api/get-view-instance-code.php', TRUE);

// REST API EP - Fetch JDB Tables
stag_define_direct_route('/'.ADMIN_PANEL_SLUG.'/api/internal/get-jdb-tables/', '/api/get-jdb-tables.php', TRUE);