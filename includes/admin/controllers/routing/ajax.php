<?php

// Ajax Core update
stag_add_route('/'.ADMIN_PANEL_SLUG.'/manage-update-rep/', '/instances/ajax/updates/core-update.php', TRUE);

// AJAX
stag_add_route('/'.ADMIN_PANEL_SLUG.'/ajax-app-upload/', '/instances/ajax/app-deploy/upload.php', TRUE);

// AJAX Get Static View
stag_add_route('/'.ADMIN_PANEL_SLUG.'/ajax-sv/', '/instances/ajax/app-views/view.static.php', TRUE);

// AJAX Code Edit Static View
stag_add_route('/'.ADMIN_PANEL_SLUG.'/ajax-ce-sv/', '/instances/ajax/get-code/get-code.static.php', TRUE);

// REST API EP - Fetch JDB Tables
stag_add_route('/'.ADMIN_PANEL_SLUG.'/ajax-app-model/', '/instances/ajax/app-model/get-jdb-tables.php', TRUE);