<?php

/** Include SU Setup script 
  * SU Script Process POST request
  * on form submit - during installation */
stag_attach_controller('/setup/superuser/main.php');

$form_token = get_form_token('su_setup_form');
$form_action = 'su_setup'; ?>

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
                  <span class="stag-icon stag-icon-person"></span>
                  <span>Create Superuser</span>
                </p>
              </div>
            </div>

            <div class="cyz-fb-body">
              <div class="py-4">
                <p>Below you should enter superuser credentials. You must create strong password and remember it and also save your password somewhere safe. Incase you lose the password then you need to manually reset it, by editing your superuser config file.</p>
              </div>
              <div class="pb-4">
                <form class="text-left" method="post" action="<?php echo get_home_url().'/?setup=su'; ?>">
                  <div class="form-group">
                    <label for="su-username">Superuser Username</label>
                    <input type="text" class="form-control" name="su-username" id="su-username" aria-describedby="su-username-help" placeholder="Enter Username" required>
                    <small id="su-username-help" class="form-text text-muted">Username can only contains alpha numeric characters including dash and underscore.</small>
                  </div>

                  <div class="form-group">
                    <label for="su-email">Superuser Email</label>
                    <input type="text" class="form-control" name="su-email" id="su-email" aria-describedby="su-email-help" placeholder="Enter Email" required>
                    <small id="su-email-help" class="form-text text-muted">Make sure you enter correct email. Otherwise, you may not be able to reset your password.</small>
                  </div>

                  <div class="form-group">
                    <label for="su-password">Superuser Password</label>
                    <input type="password" class="form-control" name="su-password" id="su-password" aria-describedby="su-password-help" placeholder="Enter Password" required>
                    <small id="su-password-help" class="form-text text-muted">Enter superuser password. Must contain at least 8 characters.</small>
                  </div>

                  <div class="form-group">
                    <label for="su-confirm-password">Confirm Superuser Password</label>
                    <input type="password" class="form-control" name="su-confirm-password" id="su-confirm-password" aria-describedby="su-confirm-password-help" placeholder="Confirm Password">
                    <small id="su-confirm-password-help" class="form-text text-muted">Confirm superuser password.</small>
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