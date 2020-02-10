<?php

// $view_name = $_GET['type'];
// $view_name_formatted = ucwords(str_replace('_', ' ', $_GET['type']));

$key = "12345";

/** CYZ VR: View Resources */
$resource_dir = get_assets_dir_uri(NULL, TRUE); ?>

<div id="body-container" class="body-container transition bg-secondary">
  <div class="body-content nice-scroll bg-light-grey">

    <div class="container-fluid py-6 px-4">

      <div class="mb-6">
        <h1 class="page-header px-3 pt-3 pb-0">
          <span class="cta first bg-primary text-white" data-link="<?php echo $_GET['view']; ?>">
            <i class="stag-ico stag-ico-arrow-back bg-primary dark-1"></i>Return
          </span>
          <!-- <span id="back-view" class="back"><i class="stag-ico stag-ico-arrow-back"></i></span> -->
          <span>Editor</span>
        </h1>
        <h2 class="px-3 pt-0 pb-3"></h2>
      </div>

      <div class="fixed-block">
        <div class="header px-3">
          <h2 class="title">Editing <?php echo explode('.', $_GET['id'])[0]; ?></h2>
        </div>
        <div class="body">

        <div class="row no-gutters">

          <!-- Code Editor -->
          <div class="col-xl-9 col-lg-8">
            <div class="editor-base pl-5" style="">
        
              <div class="block-loading-floating">
                <div class="block-loading dark">
                  <div></div>
                </div>
                <div class="block-loading dark">
                  <div></div>
                </div>
                <div class="block-loading dark">
                  <div></div>
                </div>
              </div>

              <div id="fe-php-editor" style="opacity: 0;"></div>

            </div>
    
            <script src="//cdnjs.cloudflare.com/ajax/libs/ace/1.4.4/ace.js" type="text/javascript" charset="utf-8"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/ace/1.4.4/ext-beautify.js" type="text/javascript" charset="utf-8"></script>
            <!-- load ace language tools -->
            <script src="//cdnjs.cloudflare.com/ajax/libs/ace/1.4.4/ext-language_tools.js" type="text/javascript" charset="utf-8"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/ace/1.4.4/mode-php.js" type="text/javascript" charset="utf-8"></script>

          </div>

          <!-- Sidebar -->
          <div class="col-xl-3 col-lg-4">

            <div class="block-loading">
              <div></div>
            </div>
            <div class="block-loading">
              <div></div>
            </div>
            <div class="block-loading">
              <div></div>
            </div>

            <div class="p-3 sidebar-content" style="display: none;">
              
            </div>
            
          </div>

        </div>

        </div>
      </div>
    </div>

  </div>

  <div id="swipe-h"></div>
</div>

<script>
  var app_edit = "<?php echo get_admin_panel_url().'/ajax-ce-sv/'; ?>";
  var key  = "<?php echo $key; ?>";
  var id = "<?php echo $_GET['id']; ?>";
</script>
