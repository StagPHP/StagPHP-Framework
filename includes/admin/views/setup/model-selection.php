<?php

$form_token = get_form_token('build_selection_form');
$form_action = 'build_selection'; ?>

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
                  <span class="stag-icon stag-icon-frame"></span>
                  <span>Choose Model</span>
                </p>
              </div>
            </div>

            <div class="cyz-fb-body">
              <div class="py-4">
                <p>Model defines how StagPHP framework stores data in the server. Most of the functionality stays same irrespective of the model you chose, but due to the diversity of StagONS, some of these StagONS may not work with 2nd or 3rd model. Changing model after installation is possible but not practical. If you are not sure, read the documentation <a class="link" href="https://stagphp.io/" target="_blank"><span class="stag-icon stag-icon-new-window"></span> which model I should select?</a></p>
              </div>
              <div class="pb-4">
                <form class="text-left cmf-base m-0" method="post" action="<?php echo get_home_url().'/?setup=model-selection'; ?>">

                  <!-- Radio Options List -->
                  <div class="cmf-group cmf-cr">
                    <div class="radio-item mb-3">
                      <input name="stagphp-build" type="radio" id="hybrid-build" value="hybrid-build" checked>
                      <label for="hybrid-build">
                        <span class="radio"></span>
                        <span>Default: JDB and mySQL</span>
                      </label>
                      <small class="form-text text-muted"><strong>Highly Recommended</strong>: This is default configuration for optimal performance.</small>
                    </div>
                    <div class="radio-item mb-3">
                      <input name="stagphp-build" type="radio" id="db-build" value="db-build">
                      <label for="db-build">
                        <span class="radio"></span>
                        <span>MySQL Only</span>
                      </label>
                      <small class="form-text text-muted">This make sense, if you are planning to use StagPHP application in a shared hosting environment. Store all your data in MySQL Database. With this configuration, some StagONS might not be compatible.</small>
                    </div>
                    <div class="radio-item mb-3">
                      <input name="stagphp-build" type="radio" id="lite-build" value="lite-build">
                      <label for="lite-build">
                        <span class="radio"></span>
                        <span>JDB Only</span>
                      </label>
                      <small class="form-text text-muted">JDB (JSON Database) - can be used, if your application does not require MySQL relational database. You can store data using JDB. This is suitable for simple websites and small projects. With this configuration, some StagONS might not be compatible.</small>
                    </div>
                  </div>

                  <div class="cmf-group text-center mb-3">
                    <?php echo we_safe_submit_button(
                      $form_token,
                      $form_action,
                      'Continue',
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