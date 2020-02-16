<?php

/** Include SU Setup script 
  * SU Script Process POST request
  * on form submit - during installation */
stag_attach_controller('/setup/final-step/main.php', 'admin');

$form_token = get_form_token('security_setting_form');
$form_action = 'security_setting'; ?>

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
                  <span class="stag-icon stag-icon-arrow-next"></span>
                  <span>Complete Installation</span>
                </p>
              </div>
            </div>

            <div class="cyz-fb-body">
              <div class="py-4">
                <p>Always put security on a top priority. You can now fine tune the security settings of StagPHP. Once you are done, just click on the complete installation button below, to finish the installation.</p>
              </div>
              <div class="pb-4">
                <form class="text-left cmf-base" method="post" action="<?php echo get_home_url().'/?setup=final-step'; ?>">
                  <div class="form-group">
                    <label for="admin-panel-url">Admin Panel URL</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><?php
                          echo get_home_url().'/';
                        ?></span>
                      </div>
                      <input type="text" name="admin-panel-url" class="form-control" id="admin-panel-url" aria-describedby="admin-panel-url" placeholder="Enter URL PATH / SLUG" value="su-panel" required>
                    </div>
                  </div>

                  <!-- Checkbox List -->
                  <div class="cmf-group cmf-cr">

                    <div class="checkbox-item mt-5">
                      <input type="checkbox" name="enable-unique-session" id="enable-unique-session" value="enable" checked required>
                      <label for="enable-unique-session">
                        <span class="checkbox"></span>
                        <span>Enable Unique Session</span>
                      </label>
                      <small class="form-text text-muted">Enable unique session for superuser.</small>
                    </div>

                    <div class="checkbox-item mt-4">
                      <input type="checkbox" name="enable-ip-validation" id="enable-ip-validation" value="enable" checked required>
                      <label for="enable-ip-validation">
                        <span class="checkbox"></span>
                        <span>Enable IP Validation</span>
                      </label>
                      <small class="form-text text-muted">Enable IP validation for superuser.</small>
                    </div>

                  </div>

                  <div class="cmf-group text-center mb-3">
                    <?php echo we_safe_submit_button(
                      $form_token,
                      $form_action,
                      'Create Superuser &amp; Continue',
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