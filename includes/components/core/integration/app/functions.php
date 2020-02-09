<?php

function define_view_type($view_name, $view_type = 'static'){
  /** Use Global Variable - View Watcher */
  GLOBAL $STAG_MEM_CACHE;

  // Add Static View Type
  if('static' == $view_type) $STAG_MEM_CACHE->add('view_list', $view_name, 'static');

  // Add Dynamic View Type
  if('dynamic' == $view_type) $STAG_MEM_CACHE->add('view_list', $view_name, 'dynamic');
}

function integrate_view(){
  /** Use Global View Watcher */
  GLOBAL $STAG_MEM_CACHE;

  /** View watcher data */
  $current_view_list = $STAG_MEM_CACHE->get_data_set('view_list');

  /** Get view data from local DB */
  $view_list_data = ssp_get_view_list();

  /** If View data from DB is empty, simply update the DB */
  if(!empty($current_view_list))
  ssp_update_view_list($current_view_list);

  /** If View data from watcher is empty, simply delete the DB */
  elseif(empty($current_view_list) && !empty($view_list_data))
  ssp_delete_view_list();

  /** If both view data from watcher and DB are not empty
   * compare and update the DB */
  elseif(empty($current_view_list) && !empty($view_list_data)){
    /** Difference in currently compiled view list
     * against the database */
    $view_added = array_diff_key($current_view_list, $view_list_data);

    /** Difference in stored view list in database
     * against the currently compiled data */
    $view_removed = array_diff_key($current_view_list, $view_list_data);

    /** If there is any difference - view added or removed
     * update the DB */
    if(!empty($view_added) || !empty($view_removed))
    ssp_update_view_list($current_view_list);
  }
}
