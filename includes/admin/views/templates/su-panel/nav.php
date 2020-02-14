<div id="navigation" class="navigation transition">
  <div id="menu-base" class="menu-base">

    <div class="menu-gap"></div>

    <p class="menu">
      <a href="<?php echo get_home_url(); ?>" target="_blank">
        <span class="stag-icon stag-icon-new-window"></span> App Frontend
      </a>
    </p>
    <p class="menu">
      <a href="<?php echo get_home_url().'/su-panel/'; ?>">
        <span class="stag-icon stag-icon-dashboard"></span> Dashboard
      </a>
    </p>

    <div class="menu-gap"></div>

    <p class="menu">
      <a href="<?php echo get_home_url().'/su-panel/app-model/'; ?>">
        <span class="stag-icon stag-icon-database"></span> APP Model
      </a>
    </p>

    <p class="menu drop-down" data-submenu-id="app-view">
      <a href="#">
        <span class="stag-icon stag-icon-visibility"></span> APP Views
        <span class="stag-icon stag-icon-add dropdown-icon expand"></span>
      </a>
    </p>
    <p class="sub-menu" id="sub-menu-app-view">
      <?php render_view_nav(); ?>
    </p>

    <p class="menu">
      <a href="#">
        <span class="stag-icon stag-icon-controller"></span> APP Controllers
      </a>
    </p>

    <div class="menu-gap"></div>

    <p class="menu">
      <a href="<?php echo get_home_url().'/su-panel/stagons/'; ?>">
        <span class="stag-icon stag-icon-controller"></span> StagONS
      </a>
    </p>

    <div class="menu-gap"></div>

    <p class="menu drop-down" data-submenu-id="management">
      <a href="#">
        <span class="stag-icon stag-icon-management"></span> Management
        <span class="stag-icon stag-icon-add dropdown-icon expand"></span>
      </a>
    </p>
    <p class="sub-menu" id="sub-menu-management">
      <a href="<?php echo get_home_url().'/su-panel/core-update/'; ?>" class="sub-menu-item">Manage Updates</a>
      <a href="<?php echo get_home_url().'/su-panel/app-deploy/'; ?>" class="sub-menu-item">Deploy Application</a>
      <a href="#" class="sub-menu-item">Manage Admin Users</a>
    </p>

    <p class="menu drop-down" data-submenu-id="settings">
      <a href="#">
        <span class="stag-icon stag-icon-tune"></span> Settings
        <span class="stag-icon stag-icon-add dropdown-icon expand"></span>
      </a>
    </p>
    <p class="sub-menu" id="sub-menu-settings">
      <a href="#" class="sub-menu-item">walker_chp[i]</a>
      <a href="#" class="sub-menu-item">walker_chp[i]</a>
      <a href="#" class="sub-menu-item">walker_chp[i]</a>
    </p>

    <p class="menu drop-down" data-submenu-id="tools">
      <a href="#">
        <span class="stag-icon stag-icon-tools"></span> Tools
        <span class="stag-icon stag-icon-add dropdown-icon expand"></span>
      </a>
    </p>
    <p class="sub-menu" id="sub-menu-tools">
      <a href="#" class="sub-menu-item">Import Export</a>
      <a href="#" class="sub-menu-item">Backup Management</a>
    </p>

    <div class="menu-gap"></div>

    <p class="menu">
      <a href="#">
        <span class="stag-icon stag-icon-logout"></span> Logout
      </a>
    </p>

    <div class="menu-gap"></div>
    <div class="menu-gap"></div>
  </div>
</div>
