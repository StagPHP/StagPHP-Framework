<!-- Page Header -->
<h1 class="d-block page-header p-3 mb-6">
  <span>Manage StagONS</span>
</h1>

<div class="fixed-block tabbed mb-5">

  <div class="header px-3 bg-white">
    <h2 class="title"><span class="badge badge-secondary" id="item-count">2</span> StagONS Installed</h2>
  </div>
  <div class="header-tabs bg-white">
    <a data-href="#standard-stagons-tab" class="active link" onclick="tabs_action(this);">Standard</a>
    <a data-href="#integral-stagons-tab" class="link" onclick="tabs_action(this);">Integral</a>
  </div>

  <div class="body tabbed-body">

    <div class="standard-stagons-tab tab active" style="opacity: 1;">
      <div class="row bg-mid-grey">
        <div class="col-lg-8 col-sm-12">
          <div class="p-3">
            <a class="btn cta-primary btn-rounded px-5 my-lg-0 mt-3" href="#" id="refresh-view">Refresh</a>
            <a id="select-all" data-select-class="stagon-block" class="btn cta-primary btn-rounded px-5 my-lg-0 mt-3" href="#" id="refresh-view">Select All</a>
            <a id="activate-stagon" class="btn cta-primary btn-rounded px-5 my-lg-0 mt-3" style="display: none;" href="#">Activate</a>
            <a id="deactivate-stagon" class="btn cta-primary btn-rounded px-5 my-lg-0 mt-3" style="display: none;" href="#">Deactivate</a>
            <a id="delete-item" class="btn cta-primary btn-rounded px-5 my-lg-0 mt-3" style="display: none;" href="#">Delete</a>
          </div>
        </div>
        <div class="col-lg-4 col-sm-12">
          <div class="p-3">
            <form class="m-0">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <span class="input-group-text stag-icon stag-icon-search"></span>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="lv-loading bg-white">
        <div></div>
      </div>
      <div id="drag-able" class="row stagons-list-container bg-white" style="display: none;">

      </div>
    </div>

    <div class="integral-stagons-tab tab">
      <div class="row bg-mid-grey">
        <div class="col-lg-8 col-sm-12">
          <div class="p-3">
            <a class="btn cta-primary btn-rounded px-5 my-lg-0 mt-3" href="<?php echo get_home_url().$url_retry; ?>">Add New</a>
            <a class="btn cta-primary btn-rounded px-5 my-lg-0 mt-3" href="#" id="refresh-view">Refresh</a>
            <a class="btn cta-primary btn-rounded px-5 my-lg-0 mt-3" href="#" id="refresh-view">Select All</a>
            <!-- <a class="btn cta-primary btn-rounded px-5 my-lg-0 mt-3" href="<?php echo get_home_url().$url_retry; ?>">Delete</a> -->
          </div>
        </div>
        <div class="col-lg-4 col-sm-12">
          <div class="p-3">
            <form>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <span class="input-group-text stag-icon stag-icon-search"></span>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="row">

      </div>
    </div>

  </div>

</div>

<script>
  var stag_get_stagons_list = "<?php echo get_admin_panel_url().'/api/internal/stagons/'; ?>";
</script>