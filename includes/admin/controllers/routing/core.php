<?php

// Dashboard
stag_add_route('/'.ADMIN_PANEL_SLUG.'/', '/views/instances/panel/dashboard/dashboard.php', TRUE);

// App Model
stag_add_route('/'.ADMIN_PANEL_SLUG.'/app-model/', '/views/instances/panel/app-model/app-model.php', TRUE);

// App View
stag_add_route('/'.ADMIN_PANEL_SLUG.'/app-view/', '/views/instances/panel/app-view/app-view.php', TRUE);

// App View
stag_add_route('/'.ADMIN_PANEL_SLUG.'/stagons/', '/views/instances/panel/stagons/stagons.php', TRUE);

// Core Update
stag_add_route('/'.ADMIN_PANEL_SLUG.'/core-update/', '/views/instances/panel/management/core-update.php', TRUE);

// Application Deploy
stag_add_route('/'.ADMIN_PANEL_SLUG.'/app-deploy/', '/views/instances/panel/application/deployment.php', TRUE);


// Profile Section
stag_add_route('/'.ADMIN_PANEL_SLUG.'/profile/', '/views/instances/panel/profile/profile.php', TRUE);

// Editor Instance
stag_add_route('/'.ADMIN_PANEL_SLUG.'/app-view-editor/', '/views/instances/editor/app.editor.php', TRUE);