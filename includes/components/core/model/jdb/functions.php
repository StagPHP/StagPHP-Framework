<?php

/** Include JDB library fot
 * DB Management */
stag_attach_controller('/jdb/JDB.php', 'library');

/** Setting Global - APP JSON DB Object */
GLOBAL $APP_JSON_DB;

/** Creating JSON DB Object */
$APP_JSON_DB = new CYZ_JDB(STAG_CONTAINER_DIR.'/jdb/');

/** Initialize JSON DB Object For Application */
$APP_JSON_DB->db_init('application');

/** Get app data from JSON DB */
function get_app_data($table_name){
  /** Using Global - APP JSON DB Object */
  GLOBAL $APP_JSON_DB;

  return $APP_JSON_DB->get_table($table_name);
}

/** Add app data to JSON DB */
function update_app_data($table_name, $table_data){
  /** Using Global - APP JSON DB Object */
  GLOBAL $APP_JSON_DB;

  $APP_JSON_DB->add_table($table_name);

  return $APP_JSON_DB->update_table($table_name, $table_data);
}