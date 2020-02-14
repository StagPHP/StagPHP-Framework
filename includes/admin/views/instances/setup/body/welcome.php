<?php

/** Include SU Setup script 
  * SU Script Process POST request
  * on form submit - during installation */
stag_attach_controller('/setup/setup-initiation/main.php', 'admin'); 

$form_token = get_form_token('build_selection_form');
$form_action = 'build_selection'; ?>

<div class="body-content nice-scroll bg-light-grey">
  <div class="centered-layout-container">
    <div class="bg-dark-grey">
      <div>
        <div class="install-form-base">
          <div>

            <?php stag_insert_template('/templates/gateway/header-title.php', 'admin'); ?>

            <div class="cyz-fb-title">
              <div class="title-block bg-secondary">
                <p class="text-white">
                  <span class="stag-icon stag-icon-person"></span>
                  <span>StagPHP Installation</span>
                </p>
              </div>
            </div>

            <div class="cyz-fb-body">
              <div>
                <p>Welcome to StagPHP. Select the build for your project or continue with the default. It is recommended to should check StagPHP installation guide, before you continue the installation.</p>
                <form class="text-left" method="post" action="<?php echo get_home_url().'/'; ?>">

                  <div class="form-group">
                    <div class="form-check mb-3">
                      <input class="form-check-input" type="radio" name="stagphp-build" id="hybrid-build" value="hybrid-build" checked>
                      <label class="form-check-label" for="hybrid-build">
                        Hybrid Build (Default)
                      </label>
                      <div>
                        <small class="text-muted">If you are already familiar  with installation process, than just click on the button below to get started.</small>
                      </div>
                    </div>
                    <div class="form-check mb-3">
                      <input class="form-check-input" type="radio" name="stagphp-build" id="db-build" value="db-build">
                      <label class="form-check-label" for="db-build">
                        Relational Build (DB Only)
                      </label>
                      <div>
                        <small class="text-muted">If you are already familiar  with installation process, than just click on the button below to get started.</small>
                      </div>
                    </div>
                    <div class="form-check mb-3">
                      <input class="form-check-input" type="radio" name="stagphp-build" id="lite-build" value="lite-build">
                      <label class="form-check-label" for="lite-build">
                        Lite Build (No DB)
                      </label>
                      <div>
                        <small class="text-muted">If you are already familiar  with installation process, than just click on the button below to get started.</small>
                      </div>
                    </div>
                  </div>

                  <div class="pt-2">
                    <p>If you are already familiar with installation process of the selected build, than just click on the button below to get started.</p>
                  </div>

                  <p class="text-center">
                    <?php echo we_safe_submit(
                      $form_token,
                      $form_action,
                      'Install',
                      'btn cta-primary btn-rounded'
                    ); ?>
                  </p>
                </form>
              </div>
            </div>

          <div class="cyz-fb-footer">
            <div  class="py-1">
              <a class="link" href="#">stagphp.dev</a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
