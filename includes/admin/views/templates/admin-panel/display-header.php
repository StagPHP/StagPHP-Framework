<?php
/**
 * @package:        m_framework
 * Name:            Header Template
 */

/** CYZ VR: View Resources */
$resource_dir = get_assets_dir_uri(NULL, TRUE); ?>

<header class="top-header">

  <!-- Drawer -->
  <div id="drawer" class="drawer cta transition" onClick="return toggle_menu(1);">
    <span class="bg-white"></span>
    <span class="bg-white"></span>
    <span class="bg-white"></span>
    <span class="bg-white"></span>
  </div>

  <!-- Text Logo -->
  <div class="img-logo float-left">
    <img src="<?php echo $resource_dir.'/media/logo/logo.png'; ?>">
  </div>

  <!-- Header Block -->
  <div class="header-block dropdown-block float-right last-dd d-md-inline-block d-none">
    <div class="cta">
      <span class="text-white float-left">username</span>
      <span class="bg-white float-left">SUPER ADMIN PANEL</span>
    </div>
    <div class="dropdown">
      <a href="<?php echo get_home_url().'/' ?>" target="_blank"><span class="stag-icon stag-icon-new-window mr-2"></span> App Frontend</a>
      <a href="<?php echo get_home_url().'/su-panel/logout/' ?>"><span class="stag-icon stag-icon-logout mr-2"></span> Logout</a>
    </div>
  </div>

  <!-- Header Block -->
  <div class="header-block dropdown-block float-right stag-notification-icon">
    <span class="stag-icon stag-icon-notifications text-white"></span>
    <div class="dropdown notification-list">
      <table id="notification-list">
        <tr class="no-notify">
          <td><span class="stag-icon stag-icon-check"></span></td>
          <td><a>All good! There is nothing to notify.</a></td>
        </tr>
      </table>
    </div>
  </div>

  <div class="loading-bar">
    <div class="loader"></div>
  </div>
</header>
