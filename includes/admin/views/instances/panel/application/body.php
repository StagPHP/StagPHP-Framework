<?php

/** Form Name - Used to identify form */
$form = 'app_deployment_form';

/** Form Action - Used to avoid identify form action and avoid conflict */
$form_action = 'app_deployment';

/** From Token - Used to validate form */
$form_token = get_ajax_token($form);

/** CYZ VR: View Resources */
$resource_dir = get_assets_dir_uri(NULL, TRUE); ?>


<div id="body-container" class="body-container transition bg-secondary">
<div class="body-content nice-scroll bg-light-grey">

  <div class="container-fluid py-6 px-4">
    <div class="mb-6">
      <h1 class="page-header p-3">
        <span>Application Deployment</span>
      </h1>
    </div>

    <div class="fixed-block mb-5">

      <!-- Scrolling Title -->
      <div class="sb-head my-2">
        <div class="slider slider-nav">
          <div>
            <h2>Select Deployment Option</h2>
          </div>
          <div>
            <h2>Deploy Application Package</h2>
          </div>
          <div>
            <h2>Install Deployed Application Package</h2>
          </div>
          <div>
            <h2>Finally Configure Application</h2>
          </div>
        </div>
      </div>

      <!-- Slide Content -->
      <div class="sb-content">
        <div class="slider slider-for">

          <!-- Deployment Select Slide -->
          <div class="table-list-select slider-slide">
            <div class="table-list-box p-3">
              <table class="select-deployment px-2 mt-5 mb-3" data-deploy="manual-upload-deployment">
                <tr>
                  <td class="p-2"><span class="stag-icon stag-icon-cloud-upload"></span></td>
                  <td class="p-2">
                    <h3>Upload Application Package</h3>
                  </td>
                </tr>
              </table>

              <div class="clearfix"></div>

              <table class="select-deployment px-2 mt-3 mb-5" data-deploy="github-deployment">
                <tr>
                  <td class="p-2"><span class="stag-icon stag-icon-github"></span></td>
                  <td class="p-2">
                    <h3>Enter the Application Repository URL</h3>
                  </td>
                </tr>
              </table>
            </div>
          </div>

          <!-- Deployment Package Upload/Deploy Slide -->
          <div class="slider-slide">
            <div class="p-3">
              <!-- Deployment Method Not Selected -->
              <div id="deploy-mns" style="display: none; opacity: 0;">
                <div class="cyz-alert alert-table danger">
                <table>
                <tr>
                  <td>
                    <span class="stag-icon stag-icon-error"></span>
                  </td>
                  <td class="px-2">
                    <h3 class="my-2">Error! Please Try Again.</h3>
                    <p class="my-2">You haven't selected any deployment method. Please refresh this page to try again.</p>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                    <p class="mt-3 mb-2">
                      <button type="button" href="<?php echo get_home_url().'su-panel/application'; ?>" class="btn btn-primary btn-rounded js-click">Refresh</button>
                    </p>
                  </td>
                </tr>
                </table>
                </div>
              </div>

              <!-- Manual Upload Deployment Method Selected -->
              <div id="manual-upload-deployment" style="display: none; opacity: 0;">
                <!-- Title -->
                <div class="icon-header-title text-center my-4 upload_package_title">
                  <div>
                    <span class="stag-icon stag-icon-cloud-upload"></span>
                    <h3>Upload Application Package</h3>
                  </div>
                </div>

                <!-- Upload form -->
                <form class="form" id="upload_package" method="post" action="<?php echo get_home_url().'su-panel/ajax-app-upload/'; ?>" enctype="multipart/form-data">

                  <!-- Actual Form -->
                  <div class="form-body max-800">
                    <!-- File Select -->
                    <div class="form-group">
                      <div class="file-upload-wrapper" data-text="Please select file">
                        <input id="application-upload" name="file" type="file" class="file-upload-field" required
                          data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Upload File">
                      </div>
                      <small class="form-text text-muted text-center">
                        <span id="file-hint-text"><span class="stag-icon stag-icon-zip"></span> Select Application Package
                          Zip File</span>
                      </small>
                    </div>
                  </div>

                  <div class="form-actions text-center my-4">
                    <?php echo we_safe_submit($form_token, $form_action, 'Upload', 'btn btn-primary btn-rounded'); ?>
                  </div>
                </form>

                <!-- Upload Success -->
                <div id="done_info" style="display: none; opacity: 0;">
                  <div class="cyz-alert alert-table success">
                  <table>
                  <tr>
                    <td>
                      <span class="stag-icon stag-icon-error"></span>
                    </td>
                    <td class="px-2">
                      <h3 class="my-2">Success!</h3>
                      <p class="my-2">File uploaded successfully!</p>
                    </td>
                  </tr>
                  </table>
                  </div>
                </div>

                <!-- Upload failed -->
                <div id="failed_info" style="display: none; opacity: 0;">
                  <div class="cyz-alert danger">
                    <p class="my-2 mx-1">
                      <strong>File upload failed!</strong>
                    </p>
                    <p class="my-2 mx-1">
                      There is some technical problem. Please try after some time.
                    </p>
                    <p class="my-2 mx-1">
                      <button type="button" href="<?php echo get_home_url().'/dashboard'; ?>"
                        class="btn btn-secondary btn-min-width mr-1 js-click">Return to dashboard</button>
                    </p>
                  </div>
                </div>

                <!-- uploading bar -->
                <div id="uploading_bar" style="display: none; opacity: 0;" class="max-800">
                  <div class="text-center" id="file-uploading">File Uploading - <span class="percent">0%</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%" aria-describedby="file-uploading"></div>
                  </div>
                </div>
              </div>

              <!-- Github Deployment Method Selected -->
              <div id="manual-upload-deployment" style="display: none; opacity: 0;">
                <!-- Title -->
                <div class="icon-header-title text-center my-4">
                  <div>
                    <span class="stag-icon stag-icon-github"></span>
                    <h3>Enter the Application Repository URL</h3>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>

          <!-- New Deployed Package Installation Slide -->
          <div>
            <h3>2</h3>
          </div>

          <!-- Installation Finalization Slide -->
          <div>
            <h3>3</h3>
          </div>

        </div>

        <div class="cbc-footer p-3">
          <p class="text-center">
            <a id="nb-deployment" class="btn btn-primary btn-rounded disabled" href="#" onClick="$('.slider-for').slick('slickNext');">Next Install Package</a>
          </p>
        </div>
      </div>

    </div>
  </div>

  <div id="swipe-h"></div>
  </div>
