<?php

/** Include DB Setup script 
 *  DB Script Process POST request
 *  on form submit - during installation */
stag_attach_controller('/setup/mysql/main.php', 'admin');

$form_token = get_form_token('db_setup_form');
$form_action = 'db_setup'; ?>

<div class="body-content bg-light-grey" data-scrollbar>
  <div class="centered-layout-container">
    <div class="bg-dark-grey">
      <div>
        <div class="install-form-base">
          <div>

            <?php stag_insert_template('/templates/gateway/header-title.php', 'admin'); ?>

            <div class="cyz-fb-title">
              <div class="title-block bg-secondary">
                <p class="text-white">
                  <span class="stag-icon stag-icon-database"></span>
                  <span>mySQL Details</span>
                </p>
              </div>
            </div>

            <div class="cyz-fb-body">
              <div class="py-4">
                <p>Below you should enter your database connection details. If you’re not sure about these, contact your host.</p>
              </div>
              <div class="pb-4">
                <form class="text-left m-0" method="post" action="<?php echo get_home_url().'/?setup=db'; ?>">
                  <div class="form-group">
                    <label for="database-name">Database Name</label>
                    <input type="text" class="form-control" name="database-name" id="database-name" aria-describedby="database-name-help" placeholder="Enter Database Name" value="stag_app" required>
                    <small id="database-name-help" class="form-text text-muted"> The name of the database you want to use with StagPHP.</small>
                  </div>

                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" aria-describedby="username-help" placeholder="Enter Username" value="root" required>
                    <small id="username-help" class="form-text text-muted"> Your database username.</small>
                  </div>

                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" name="password" id="password" aria-describedby="password-help" placeholder="Enter Password">
                    <small id="password-help" class="form-text text-muted">Your database password.</small>
                  </div>

                  <div class="form-group">
                    <label for="db-host">Database Host</label>
                    <input type="text" class="form-control" name="db-host" id="db-host" aria-describedby="db-host-help" placeholder="Enter Database Host" value="localhost" required>
                    <small id="db-host-help" class="form-text text-muted">You should be able to get this info from your web host, if localhost doesn’t work.</small>
                  </div>

                  <div class="form-group">
                    <label for="tb-prefix">Table Prefix</label>
                    <input type="text" class="form-control" name="tb-prefix" id="tb-prefix" aria-describedby="tb-prefix-help" placeholder="Enter Table Prefix" value="stag_" required>
                    <small id="tb-prefix-help" class="form-text text-muted">If you want to run multiple StagPHP installations in a single database, change this.</small>
                  </div>

                  <div class="cmf-group text-center mb-3">
                    <?php echo we_safe_submit_button(
                      $form_token,
                      $form_action,
                      'Validate &amp; Continue',
                      'btn cta-primary btn-rounded submit-button'
                    ); ?>
                  </div>
                </form>
              </div>
            </div>

            <div class="cyz-fb-footer">
              <div class="py-1">
                <p><a class="link" href="https://stagphp.io/" target="_blank">StagPHP <span class="stag-icon stag-icon-new-window"></span></a> Framework <?php echo STAG_VERSION; ?></p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>