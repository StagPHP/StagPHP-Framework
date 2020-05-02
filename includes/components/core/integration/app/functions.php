<?php

function stag_create_navigation_for_view_types(){
    /** Use Global View Watcher */
    GLOBAL $STAG_MEM_CACHE;
  
    /** View watcher data */
    $current_view_list = $STAG_MEM_CACHE->get_data_set('view_list');
  
    /** Get view data from local DB */
    $view_list_data = stag_model_get_view_types();
  
    /** If View data from DB is empty, simply update the DB */
    if(empty($view_list_data))
    stag_model_update_view_types($current_view_list);
  
    /** If View data from watcher is empty, simply delete the DB */
    elseif(empty($current_view_list) && !empty($view_list_data))
    stag_model_delete_view_types();
  
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
        stag_model_update_view_types($current_view_list);
    }
}

function stag_discover_app_views(){
    $view_file_list = array();

    // Create new file manger instance
    $file_manager = new stag_file_manager('/app/');

    $l1_dir_scan_result = $file_manager->scan_directory(array(
        'directory' => '/views/'
    ));

    if(TRUE === $l1_dir_scan_result['status']){
        $l1_all_files = $l1_dir_scan_result['files'];

        foreach($l1_all_files as $l1_file){
            array_push(
                $view_file_list,
                STAG_APP_DIR.'/views/'.$l1_directory.'/'.$l1_file
            );
        }

        $l1_all_directories = $l1_dir_scan_result['directories'];

        foreach($l1_all_directories as $l1_directory){
            $l2_dir_scan_result = $file_manager->scan_directory(array(
                'directory' => '/views/'.$l1_directory
            ));

            if(TRUE === $l2_dir_scan_result['status']){
                $l2_all_files = $l2_dir_scan_result['files'];

                foreach($l2_all_files as $l2_file){
                    array_push(
                        $view_file_list,
                        STAG_APP_DIR.'/views/'.$l1_directory.'/'.$l2_file
                    );
                }
            }
        }
    }

    if(empty($view_file_list)) return FALSE;
    else return $view_file_list;
}

function stag_update_static_view_list($type){
    // $view_list_in_db = stag_model_get_view_list_of_types($_POST['name']);

    $discovered_view_list = stag_discover_app_views();

    $complied_view_list = array();

    foreach($discovered_view_list as $view_loc){
        $view_loc = str_replace('\\', '/', $view_loc);

        $view_data = stag_phrase_comment::file(
            $view_loc,
            array("View", "Name", "Date Create", "Date Updated")
        );

        if($type == $view_data['View']){
            $created_time = strtotime($view_data['Date Create']);
            $created_time = date('Y-m-d',$created_time);
      
            $updated_time = strtotime($view_data['Date Updated']);
            $updated_time = date('Y-m-d',$updated_time);

            $view_data = array(
                'id'            => $type.'.'.($key + 1),
                'instance_name' => $view_data['Name'],
                'date_created'  => $created_time,
                'date_updated'  => $updated_time,
                'abs_location'  => $view_loc
            );

            array_push($complied_view_list, $view_data);
        }
    }

    stag_model_update_view_list_of_types($type, $complied_view_list);
}