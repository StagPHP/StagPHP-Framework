<?php

// Dashboard
stag_add_route('/'.ADMIN_PANEL_SLUG.'/', '/instances/panel/dashboard/dashboard.php', TRUE);

// Core Update
stag_add_route('/'.ADMIN_PANEL_SLUG.'/core-update/', '/instances/panel/management/core-update.php', TRUE);

// Application Deploy
stag_add_route('/'.ADMIN_PANEL_SLUG.'/app-deploy/', '/instances/panel/application/deployment.php', TRUE);

// App Model
stag_add_route('/'.ADMIN_PANEL_SLUG.'/app-model/', '/instances/panel/app-model/app-model.php', TRUE);

// App View
stag_add_route('/'.ADMIN_PANEL_SLUG.'/app-view/', '/instances/panel/app-view/app-view.php', TRUE);

// Profile Section
stag_add_route('/'.ADMIN_PANEL_SLUG.'/profile/', '/instances/panel/profile/profile.php', TRUE);

// Editor Instance
stag_add_route('/'.ADMIN_PANEL_SLUG.'/app-view-editor/', '/instances/editor/app.editor.php', TRUE);