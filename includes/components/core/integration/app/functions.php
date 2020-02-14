<?php

function define_view_type($view_name, $view_type = 'static'){
  /** Use Global Variable - View Watcher */
  GLOBAL $STAG_MEM_CACHE;

  // Add Static View Type
  if('static' == $view_type) $STAG_MEM_CACHE->add('view_list', $view_name, 'static');

  // Add Dynamic View Type
  if('dynamic' == $view_type) $STAG_MEM_CACHE->add('view_list', $view_name, 'dynamic');
}