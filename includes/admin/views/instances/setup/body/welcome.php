<?php

/** Include SU Setup script 
  * SU Script Process POST request
  * on form submit - during installation */
stag_attach_controller('/setup/setup-initiation/main.php', 'admin'); 

$form_token = get_form_token('agreement_acceptance_form');
$form_action = 'agreement_acceptance'; ?>

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
                  <span>StagPHP Installation</span>
                </p>
              </div>
            </div>

            <div class="cyz-fb-body">
              <div class="py-4">
                <p>Welcome to StagPHP. Select the build for your project or continue with the default. It is recommended to should check StagPHP installation guide, before you continue the installation.</p>
              </div>
              <div class="letter-head" style="width:100%; max-width: 100%; height: 400px; overflow: auto;" data-scrollbar>
                <div class="mx-auto text-left py-3 pb-4"  style="max-width: 600px;">
                  <?php echo file_get_contents(STAG_ADMIN_VIEWS_DIR.'/instances/setup/body/terms-of-use.txt') ?>
                </div>
              </div>
              <div class="py-4">
                <form class="cmf-base" method="post" action="<?php echo get_home_url().'/'; ?>">

                  <!-- Checkbox List -->
                  <div class="cmf-group cmf-cr">

                    <div class="checkbox-item mt-3">
                      <input type="checkbox" name="checkbox-options" id="checkbox-1" required>
                      <label for="checkbox-1">
                        <span class="checkbox"></span>
                        <span>I Understand</span>
                      </label>
                      <small class="form-text text-muted">Checkbox 1 description, description.</small>
                    </div>

                  </div>

                  <div class="cmf-group text-center mb-3">
                    <?php echo we_safe_submit_button(
                        $form_token,
                        $form_action,
                        'Accept &amp; Continue',
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