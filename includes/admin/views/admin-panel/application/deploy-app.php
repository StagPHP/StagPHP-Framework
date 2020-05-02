<!-- Page Header -->
<h1 class="d-block page-header p-3 mb-6">
  <span>Deploy Application</span>
</h1>

<div class="row px-3">
  <div class="col-lg-4 col-12 d-lg-block d-none">
    <h2 class="mb-4 simple-heading">
      <strong>Select Method</strong>
    </h2>
    <div class="simple-nav">
      <ul>
        <li><a href="#" class="active">
          <span class="stag-icon stag-icon-arrow-next"></span> Direct Upload
        </a></li>
      </ul>
    </div>
  </div>
  <div class="col-lg-8 col-12">

    <!-- Success Alert -->
    <div id="success-alert" class="alert alert-success" role="alert" style="display: none;">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <span></span>
    </div>

    <!-- Failed Alert -->
    <div id="failed-alert" class="alert alert-danger" role="alert" style="display: none;">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <span></span>
    </div>

    <!-- Zip File Upload Form -->
    <form action="<?php echo get_home_url().'/su-panel/api/internal/deploy-app/'; ?>" enctype="multipart/form-data" method="post" id="zu-form" data-file-name="Application">
      <div class="zf-upload-block">
        <table class="my-5">
          <!-- Zip Upload Form Block Title -->
          <tr>
            <td>
              <table class="my-5 mx-auto">
                <tr id="zu-form-title">
                  <td><h2>Drag and Drop Application</h2></td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Zip Upload Separator -->
          <tr id="zu-sep">
            <td>
              <p class="mt-0 pb-5">OR</p>
            </td>
          </tr>

          <!-- Zip Upload Select File Button -->
          <tr id="zu-select-file-base">
            <td>
              <input name="action" class="hidden" value="upload" hidden/>

              <!-- [[ File Name ]] -->
              <input name="zu-file-name" id="zu-file-name" class="hidden" hidden/>

              <input type="file" id="zu-upload-field" name="zu-upload-field"/>
              <label for="zu-upload-field">Select Application</label>
            </td>
          </tr>

          <tr id="zu-restart-process" style="display: none;">
            <td>
              <div>
                <a id="restart-retry-upload" href="<?php echo get_current_url(); ?>" class="zf-button">
                  Deploy Again
                </a>
              </div>
            </td>
          </tr>

          <tr id="zu-installing-zip" style="display: none;">
            <td>
              <div class="py-5">
                <div class="box-loader">
                  <div class="ajax-loader"></div>
                </div>
              </div>
            </td>
          </tr>

          <tr id="zu-submit-button" style="display: none;">
            <td>
              <button class="mb-5" type="submit">Upload &amp; Install</button>
            </td>
          </tr>

          <tr id="zf-footer">
            <td>
              <div class="text-center mt-5">
                <p class="m-0 text-muted">Only Zip File Supported</p>
              </div>
            </td>
          </tr>
          
          <tr id="zu-upload-progress" style="display: none;">
            <td>
              <div class="progress my-5 mx-3">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-info"></div>
              </div>
            </td>
          </tr>
        </table>
      </div>
    </form>
  </div>
</div>