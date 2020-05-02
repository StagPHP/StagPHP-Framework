<div id="navigation" class="navigation transition">
  <div id="menu-base" class="menu-base">

    <div class="menu-gap"></div>

    <p class="menu">
      <a href="<?php echo get_home_url(); ?>" target="_blank">
        <span class="stag-icon stag-icon-new-window"></span>
        <span>App Frontend</span>
      </a>
    </p>
    <p class="menu">
      <a href="<?php echo get_home_url().'/su-panel/'; ?>">
        <span class="stag-icon stag-icon-dashboard"></span>
        <span>Dashboard</span>
      </a>
    </p>

    <div class="menu-gap"></div>
      
    <p class="menu drop-down" data-submenu-id="deploy-app">
      <a href="#">
        <span class="stag-icon stag-icon-application"></span>
        <span>Application</span>
        <span class="stag-icon stag-icon-down dropdown-icon expand"></span>
      </a>
    </p>
    <p class="sub-menu" id="sub-menu-deploy-app">
      <a href="<?php echo get_home_url().'/su-panel/deploy-app/'; ?>" class="sub-menu-item">Deploy</a>
    </p>
  
    <p class="menu drop-down" data-submenu-id="stagons">
      <a href="#">
        <span class="stag-icon stag-icon-controller"></span>
        <span>StagONS</span>
        <span class="stag-icon stag-icon-down dropdown-icon expand"></span>
      </a>
    </p>
    <p class="sub-menu" id="sub-menu-stagons">
      <a href="<?php echo get_home_url().'/su-panel/stagons/'; ?>" class="sub-menu-item">All StagONS</a>
      <a href="<?php echo get_home_url().'/su-panel/add-stagon/'; ?>" class="sub-menu-item">Add StagON</a>
    </p>

    <div class="menu-gap"></div>

    <p class="menu drop-down" data-submenu-id="user-setting">
      <a href="#">
        <span class="stag-icon stag-icon-account-circle"></span>
        <span>Profile</span>
        <span class="stag-icon stag-icon-down dropdown-icon expand"></span>
      </a>
    </p>
    <p class="sub-menu" id="sub-menu-user-setting">
      <a href="<?php echo get_home_url().'/su-panel/profile/'; ?>" class="sub-menu-item">Your Profile</a>
    </p>

    <p class="menu drop-down" data-submenu-id="management">
      <a href="#">
        <span class="stag-icon stag-icon-management"></span>
        <span>Management</span>
        <span class="stag-icon stag-icon-down dropdown-icon expand"></span>
      </a>
    </p>
    <p class="sub-menu" id="sub-menu-management">
      <a href="<?php echo get_home_url().'/su-panel/update/'; ?>" class="sub-menu-item">Updates</a>
    </p>

    <div class="menu-gap"></div>

    <p class="menu">
      <a href="#">
        <span class="stag-icon stag-icon-logout"></span>
        <span>Logout</span>
      </a>
    </p>

    <div class="menu-gap"></div>
    <div class="menu-gap"></div>
  </div>
</div>
