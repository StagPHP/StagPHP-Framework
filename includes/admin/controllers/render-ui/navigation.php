<?php

function render_view_nav(){
  $nav_data_array = stag_model_get_view_types();

  if(empty($nav_data_array) || !is_array($nav_data_array)) return '';

  foreach($nav_data_array as $nav_data) foreach($nav_data as $view_name => $view_type){
    $view_name_formatted = str_replace('_', ' ', $view_name);
    
    echo '<a id="'.$view_name.'-link" href="'.get_home_url().'/'.ADMIN_PANEL_SLUG.'/app-view/?type='.$view_name.'" class="sub-menu-item '.$view_type.'">'.$view_name_formatted.'</a>';
  }
}