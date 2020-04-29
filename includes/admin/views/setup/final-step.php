<?php

/** Include SU Setup script 
  * SU Script Process POST request
  * on form submit - during installation */
stag_attach_controller('/setup/final-step/main.php');

$form_token = get_form_token('security_setting_form');
$form_action = 'security_setting'; ?>

<div class="body-content bg-light-grey" data-scrollbar>
  <div class="centered-layout-container">
    <div class="bg-dark-grey">
      <div>
        <div class="install-form-base">
          <div>

            <?php stag_attach_template('/templates/action-screen/header-title.php'); ?>

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
                <p>Installation is almost finished! You can now fine tune the email &amp; security settings of StagPHP. Once you are done, just click on the install button below, to complete the installation.</p>
              </div>
              <div class="pb-4">
                <form class="text-left cmf-base" method="post" action="<?php echo get_home_url().'/?setup=final-step'; ?>">
                  
                  <h2 class="py-3">Email Settings</h2>

                  <div class="form-group">
                    <label for="sender-name">Sender Name</label>
                    <input type="text" class="form-control" name="sender-name" id="sender-name" aria-describedby="sender-name-help" placeholder="StagPHP" value="StagPHP" required>
                    <small id="sender-name-help" class="form-text text-muted">Email sender name (or) from name.</small>
                  </div>

                  <div class="form-group">
                    <?php
                      $sender_email = 'no-reply@'.preg_replace('/((https\:\/\/)|(http\:\/\/))/', '', CURRENT_DOMAIN);
                    ?>
                    <label for="sender-email">Sender Email</label>
                    <input type="text" class="form-control" name="sender-email" id="sender-email" aria-describedby="sender-email-help" placeholder="<?php echo $sender_email; ?>" value="<?php echo $sender_email; ?>" type="email" required>
                    <small id="sender-email-help" class="form-text text-muted">Email sender email (or) from email.</small>
                  </div>

                  <div class="form-group">
                    <?php $reply_to_name = stag_session_cache::get_data('user_credential', 'name'); ?>
                    <label for="reply-to-name">Reply to Name</label>
                    <input type="text" class="form-control" name="reply-to-name" id="reply-to-name" aria-describedby="reply-to-name-help" placeholder="<?php echo $reply_to_name; ?>" value="<?php echo $reply_to_name; ?>" required>
                    <small id="reply-to-name-help" class="form-text text-muted">Reply to name - when some one reply to the email.</small>
                  </div>

                  <div class="form-group">
                    <?php $reply_to_email = stag_session_cache::get_data('user_credential', 'email'); ?>
                    <label for="reply-to-email">Sender Email</label>
                    <input type="text" class="form-control" name="reply-to-email" id="reply-to-email" aria-describedby="reply-to-email-help" placeholder="<?php echo $reply_to_email; ?>" value="<?php echo $reply_to_email; ?>" type="email" required>
                    <small id="reply-to-email-help" class="form-text text-muted"> Email sender email (or) from email.</small>
                  </div>

                  <hr class="form-sep mt-5 pb-3"/>

                  <h2 class="py-3">Security Settings</h2>

                  <!-- Admin Panel URL -->
                  <div class="form-group">
                    <label for="backend-url">Admin Panel URL</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><?php
                          echo get_home_url().'/';
                        ?></span>
                      </div>
                      <input type="text" name="backend-url" class="form-control" id="backend-url" aria-describedby="backend-url" placeholder="Enter URL PATH / SLUG" value="su-panel" required>
                    </div>
                  </div>

                  <!-- Checkbox List -->
                  <div class="cmf-group cmf-cr">

                    <div class="checkbox-item mt-6">
                      <input type="checkbox" name="enable-unique-session" id="enable-unique-session" value="enabled" checked>
                      <label for="enable-unique-session">
                        <span class="checkbox"></span>
                        <span>Enable Unique Session</span>
                      </label>
                      <small class="form-text text-muted">Enable unique session for superuser</small>
                    </div>

                    <div class="checkbox-item mt-4">
                      <input type="checkbox" name="enable-ip-validation" id="enable-ip-validation" value="enabled" checked>
                      <label for="enable-ip-validation">
                        <span class="checkbox"></span>
                        <span>Enable IP Validation</span>
                      </label>
                      <small class="form-text text-muted">Enable IP validation for superuser</small>
                    </div>

                    <div class="checkbox-item mt-4">
                      <input type="checkbox" name="enable-debug" id="enable-debug" value="enabled">
                      <label for="enable-debug">
                        <span class="checkbox"></span>
                        <span>Enable Debug Logs</span>
                      </label>
                      <small class="form-text text-muted">Enable debug log generation</small>
                    </div>

                  </div>

                  <div class="cmf-group text-center mb-3">
                    <?php echo we_safe_submit_button(
                      $form_token,
                      $form_action,
                      'Install',
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