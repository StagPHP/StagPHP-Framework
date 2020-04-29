<?php

$response = stag_is_update_available(); ?>

<!-- Page Header -->
<h1 class="d-block page-header p-3 mb-6">
  <span>Manage Updates</span>
</h1>

<div class="fixed-block">
  <div class="body">

    <?php if($response[0]): ?>
    <div class="row align-items-top px-3">
      <div class="col-lg-2 col-sm-12">
        <div class="update-icons">
          <span class="stag-icon stag-icon-error-solid"></span>
        </div>
      </div>
      <div class="col-lg-10 col-sm-12">
        <p class="my-3"><span id="stag-update-description">New version of StagPHP (V <?php echo $response[1]; ?>) is available. You have outdated StagPHP (V <?php echo STAG_VERSION; ?>). Update StagPHP now for better security.</span></p>
        <ul id="core-update-step-response" class="stag-check-list my-3">

        </ul>
        <p class="my-3">
          <a id="stagphp-core-update-init" class="btn cta-primary btn-rounded px-2" href="#">Update</a>
        </p>
      </div>
    </div>
    <?php else: ?>
    <div class="row align-items-top px-3">
      <div class="col-lg-2 col-sm-12">
        <div class="update-icons">
          <span class="stag-icon stag-icon-check-circle-solid"></span>
        </div>
      </div>
      <div class="col-lg-10 col-sm-12">
        <p class="my-3"><span>Congratulations! Latest version of StagPHP framework (V <?php echo STAG_VERSION; ?>) is installed. Automatic update is also enabled! So, StagPHP will update automatically while you focus on more important tasks. If you want to rollback the last update, follow the documentation.</span></p>
      </div>
    </div>
    <?php endif; ?>

  </div>
</div>