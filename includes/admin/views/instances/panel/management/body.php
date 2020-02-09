<?php

$response = stag_is_update_available(); ?>

<div id="body-container" class="body-container transition bg-secondary">
  <div class="body-content nice-scroll bg-light-grey">

    <div class="container-fluid py-6 px-4">
    
      <div class="mb-6">
        <h1 class="page-header p-3">
          <span>StagPHP Update</span>
        </h1>
      </div>

      <div class="fixed-block">
        <div class="body">        

        <?php if($response[0]): ?>
          <div class="row align-items-center px-3">
            <div class="col-lg-2 col-sm-12">
              <div class="update-icons">
                <span class="cyz-ico cyz-ico-error-solid"></span>
              </div>
            </div>
            <div class="col-lg-10 col-sm-12">
              <p><span>New version of StagPHP (V <?php echo $response[1]; ?>) is available. You have outdated StagPHP (V <?php echo STAG_VERSION; ?>). Update StagPHP now for better security.</span></p>
              <p class="mt-4">
                <a class="btn cta-primary btn-rounded px-2 cyz-update" href="#" data-update="download-core-update">Update</a>
              </p>
            </div>
          </div>
        <?php else: ?>
          <div class="row align-items-center px-3">
            <div class="col-lg-2 col-sm-12">
              <div class="update-icons">
                <span class="cyz-ico cyz-ico-check-circle-solid"></span>
              </div>
            </div>
            <div class="col-lg-10 col-sm-12">
              <p><span>Congratulations! Latest version of StagPHP framework (V <?php echo stag_get_latest_build_version(); ?>) is installed. Automatic update is also enabled! So, StagPHP will update automatically while you focus on more important tasks. If you want to rollback the last update, follow the documentation.</span></p>
            </div>
          </div>
        <?php endif; ?>

        </div>
      </div>

    </div>

  </div>

  <div id="swipe-h"></div>

  <!-- Attach Display Footer -->
  <?php stag_insert_template('/templates/su-panel/sub-footer.php', 'admin'); ?>
</div>
