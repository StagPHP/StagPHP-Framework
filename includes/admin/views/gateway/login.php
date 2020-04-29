<?php

/** Form Credentials */
$form_token = get_form_token('su_login_form');
$form_action = 'su_login';
global $form_error; ?>

<div class="body-content action-page bg-light-grey" data-scrollbar style="background-image: url(<?php  echo get_assets_dir_uri(NULL, TRUE).'/media/backgrounds/action-page-bg.png'; ?>);">
  <div class="centered-layout-container">
    <div class="bg-dark-grey">
      <div>
        <div class="install-form-base">
          <div>

            <?php stag_attach_template('/templates/action-screen/header-title.php'); ?>

            <div class="cyz-fb-title">
            <?php if(count($form_error) > 0): foreach($form_error as $error): ?>
              <div class="title-block bg-danger">
                <p class="text-white">
                  <span class="stag-icon stag-icon-error"></span>
                  <span><strong>ERROR:</strong> <?php echo $error; ?></span>
                </p>
              </div>
            <?php endforeach; else: ?>
              <div class="title-block bg-secondary">
                <p class="text-white">
                  <span class="stag-icon stag-icon-person"></span>
                  <span>Super User Login</span>
                </p>
              </div>
            <?php endif; ?>
            </div>

            

            <div class="cyz-fb-body">
              <div class="py-4">
                <form class="text-left" method="post" action="<?php echo get_current_url(); ?>">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" aria-describedby="username-help" placeholder="Enter Username" value="" required>
                  </div>

                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" aria-describedby="password-help" placeholder="Enter Password" value="">
                    <a class="link-below-input link" href="#">Forgot Password?</a>
                  </div>

                  <div class="cmf-group cmf-cr">
                    <div class="checkbox-item mt-3">
                      <input type="checkbox" name="remember-me" id="remember-me" value="yes">
                      <label for="remember-me">
                        <span class="checkbox"></span>
                        <span>Remember Me</span>
                      </label>
                      <small class="form-text text-muted">Check this only if you are logging it from your personal device.</small>
                    </div>
                  </div>

                  <div class="cmf-group text-center mb-3">
                    <?php echo we_safe_submit_button(
                      $form_token,
                      $form_action,
                      'Login',
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
