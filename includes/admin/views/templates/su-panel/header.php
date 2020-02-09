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
  <div class="img-logo pull-left">
    <img src="<?php echo $resource_dir.'/media/logo/logo.png'; ?>">
  </div>

  <!-- Header Block -->
  <div class="header-block pull-right dropdown-block last-dd d-md-inline-block d-none">
    <div class="cta">
      <span class="text-white">DevGK</span>
      <span class="bg-white">SUPER ADMIN PANEL</span>
    </div>
    <div class="dropdown">
      <a href="<?php echo get_home_url().'/' ?>" target="_blank"><span class="cyz-ico cyz-ico-new-window mr-2"></span> App Frontend</a>
      <a href="<?php echo get_home_url().'/su-panel/logout/' ?>"><span class="cyz-ico cyz-ico-logout mr-2"></span> Logout</a>
    </div>
  </div>

  <!-- Header Block -->
  <div class="right-cta-icon dropdown-block">
    <span class="cyz-ico notification cyz-ico-notifications text-white"></span>
    <div class="dropdown notification-list">
      <table id="notification-list">
        <tr class="no-notify">
          <td><span class="cyz-ico cyz-ico-check"></span></td>
          <td><a>All good! There is nothing to notify.</a></td>
        </tr>
      </table>
    </div>
  </div>

  <div class="loading-bar">
    <div class="loader"></div>
  </div>
</header>
