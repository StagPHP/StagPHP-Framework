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
  
    <p class="menu drop-down" data-submenu-id="stagons">
      <a href="#">
        <span class="stag-icon stag-icon-controller"></span> StagONS
        <span class="stag-icon stag-icon-down dropdown-icon expand"></span>
      </a>
    </p>
    <p class="sub-menu" id="sub-menu-stagons">
      <a href="<?php echo get_home_url().'/su-panel/stagons/'; ?>" class="sub-menu-item">All StagONS</a>
    </p>

    <div class="menu-gap"></div>

    <p class="menu drop-down" data-submenu-id="user-setting">
      <a href="#">
        <span class="stag-icon stag-icon-account-circle"></span> Profile
        <span class="stag-icon stag-icon-down dropdown-icon expand"></span>
      </a>
    </p>
    <p class="sub-menu" id="sub-menu-user-setting">
      <a href="<?php echo get_home_url().'/su-panel/profile/'; ?>" class="sub-menu-item">Your Profile</a>
    </p>

    <p class="menu drop-down" data-submenu-id="management">
      <a href="#">
        <span class="stag-icon stag-icon-management"></span> Management
        <span class="stag-icon stag-icon-down dropdown-icon expand"></span>
      </a>
    </p>
    <p class="sub-menu" id="sub-menu-management">
      <a href="<?php echo get_home_url().'/su-panel/update/'; ?>" class="sub-menu-item">Updates</a>
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
