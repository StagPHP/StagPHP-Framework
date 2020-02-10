<?php

$view_name = $_GET['type'];
$view_name_formatted = ucwords(str_replace('_', ' ', $_GET['type']));

$key = "12345";

/** CYZ VR: View Resources */
$resource_dir = get_assets_dir_uri(NULL, TRUE); ?>

<div id="body-container" class="body-container transition bg-secondary">
  <div class="body-content nice-scroll bg-light-grey">

    <div class="container-fluid py-6 px-4">

      <div class="mb-6">
        <h1 class="page-header p-3">
          <span><?php echo $view_name_formatted; ?></span>
          <span class="cta disabled bg-primary text-white">
            <i class="stag-ico stag-ico-add"></i>Add New
          </span>
          <span id="refresh-view" class="refresh">
            <i class="stag-ico stag-ico-refresh bg-primary text-white"></i>
          </span>
        </h1>
      </div>

      <div class="fixed-block">
        <div class="header px-3">
          <h2 class="title"><?php echo $view_name_formatted; ?> List</h2>
        </div>
        <div class="body list-view" data-view="<?php echo $view_name; ?>">

          <div class="lv-loading">
            <div></div>
          </div>

          <div class="lv-lists error" style="display: none;">
            <p class="p-3">Error occurred! Try to refresh this page.</p>
          </div>

          <div class="lv-lists no-result" style="display: none;">
            <p class="p-3">No <strong><?php echo $view_name_formatted; ?></strong> Found</p>
          </div>

          <div class="lv-head bg-grey" style="display: none;">
            <table>
              <tr>
                <td class="py-2 px-3"><input type="checkbox"/></td>
                <td class="p-3">Name</td>
                <td class="p-3">Date</td>
              </tr>
            </table>
          </div>
          <div id="lv-list" class="lv-lists" style="display: none;">
          </div>

        </div>
      </div>

    </div>

  </div>

  <div id="swipe-h"></div>
</div>

<script>
  var app_view = "<?php echo get_admin_panel_url().'/ajax-sv/'; ?>";
  var app_view_editor = "<?php echo get_admin_panel_url().'/app-view-editor/'; ?>";
  var key  = "<?php echo $key; ?>";
  var name = "<?php echo $view_name; ?>";
</script>
