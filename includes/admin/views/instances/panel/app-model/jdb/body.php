<?php

/** Form Name - Used to identify form */
$form = 'app_deployment_form';

/** Form Action - Used to avoid identify form action and avoid conflict */
$form_action = 'app_deployment';

/** From Token - Used to validate form */
$form_token = get_ajax_token($form);

/** CYZ VR: View Resources */
$resource_dir = get_assets_dir_uri(NULL, TRUE); ?>


<div id="body-container" class="body-container transition bg-secondary">
  <div class="body-content nice-scroll bg-light-grey">

    <div class="container-fluid py-6 px-4">
      <div class="mb-6">
        <h1 class="page-header p-3">
          <span>Application DB Models</span>
        </h1>
      </div>

      <div class="fixed-block tabbed mb-5">

        <div class="header px-3">
          <h2 class="title">DB Explorer</h2>
        </div>
        <div class="header-tabs">
          <a data-href="#jdb-tab" class="active link" onclick="tabs_action(this, jdb_get_db);">JDB</a>
          <a data-href="#sql-tab" class="link" onclick="tabs_action(this);">SQL <?php // echo DB_NAME; ?></a>
        </div>
        <div class="body tabbed-body">

          <div class="lv-loading">
            <div></div>
          </div>

          <div class="jdb-tab tab active" style="opacity: 1;">
            <div class="p-3">
              <h2>JDB DB Tab</h2>
            </div>
            <div class="pt-2">
              <table class="data-table no-border" cellspacing="0" cellpadding="0">
                <thead>
                  <tr>
                    <td class="pl-3" colspan="2">Database Name</td>
                    <td class="pr-3">Action</td>
                  </tr>
                </thead>
                <tbody id="db-names"></tbody>
              </table>
            </div>
          </div>

          <div class="sql-tab tab">
            <div class="p-3">
              <h2>SQL DB Tab</h2>
            </div>
          </div>

        </div>

      </div>
    </div>

    <div id="swipe-h"></div>
  </div>

  <div id="swipe-h"></div>
</div>

<script>
  var app_model_query = "<?php echo get_admin_panel_url().'/ajax-app-model/'; ?>";
</script>
