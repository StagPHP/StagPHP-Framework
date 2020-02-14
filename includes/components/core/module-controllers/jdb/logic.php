<?php

require_once 'functions.php';

function ssp_get_view_list(){
  /** Set table name */
  $table_name = 'app_view';

  /** get and return app view data */
  return get_app_data($table_name);
}

function ssp_delete_view_list(){
  /** Set table name */
  $table_name = 'app_view';

  /** Delete Result */
  return delete_table($table_name);
}

function ssp_update_view_list($view_list){
  /** Set table name */
  $table_name = 'app_view';

  /** Return Result */
  return update_app_data($table_name, $view_list);
}

function ssp_get_active_plugins(){
  /** Set table name */
  $table_name = 'stagons';

  /** get and return app view data */
  return get_app_data($table_name);
}