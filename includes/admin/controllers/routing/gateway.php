<?php

// Gateway Login
stag_add_route('/'.ADMIN_PANEL_SLUG.'/login/', '/instances/gateway/login.php', TRUE);

// Gateway Logout
stag_add_route('/'.ADMIN_PANEL_SLUG.'/logout/', '/instances/gateway/logout.php', TRUE);