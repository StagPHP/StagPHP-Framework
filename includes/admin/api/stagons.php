<?php

/** API response template */
stag_include_controller('/functions/response-template.php', 'admin-api');

/** Secure internal api functions */
stag_include_controller('/functions/secure-request-internal.php', 'admin-api');

if(empty($_POST['action'])){
  error_response(array(
    'description' => 'Invalid request!',
  ));
}

if ('get' == $_POST['action']){
  $stagons_list = get_compiled_plugin_list();

  if(!empty($stagons_list)){
    success_response(array(
      'description'   => 'Stagons list fetched!',
      'result'        => array(
        'view-list'       => $stagons_list
      )
    ));
  } else {
    error_response(array(
      'description'   => 'Stagons list failed to fetch!'
    ));
  }
}

else if('refresh' == $_POST['action']){
  // stag_update_static_view_list($_POST['name']);

  // success_response(array(
  //   'description'   => 'Views list database updated!',
  //   'result'        => array()
  // ));
}

else if ('activate' == $_POST['action']){
  if (isset($_POST['plugins-csv']) && !empty($_POST['plugins-csv'])) {
    $active_plugins = explode(',', $_POST['plugins-csv']);

    if(count($active_plugins) < 1) $active_plugins = array();
  }
  else error_response();

  $result = stag_activate_plugins($active_plugins);

  if ($result){
    success_response(array(
      'description'   => 'Plugins activated'
    ));
  } else {
    error_response(array(
      'description'   => 'Plugins can not be activated'
    ));
  }
}

else if ('deactivate' == $_POST['action']){
  if (isset($_POST['plugins-csv']) && !empty($_POST['plugins-csv'])) {
    $deactivate_plugins = explode(',', $_POST['plugins-csv']);

    if(count($deactivate_plugins) < 1) $deactivate_plugins = array();
  }
  else error_response();

  $result = stag_deactivate_plugins($deactivate_plugins);

  if ($result){
    success_response(array(
      'description'   => 'Plugins activated'
    ));
  } else {
    error_response(array(
      'description'   => 'Plugins can not be activated'
    ));
  }
}



// single and bulk Activate

// single and bulk Deactivate
// single and bulk delete
// Refresh
// Add New