<?php

function discover_plugins(){
    // Create new file manger instance
    $file_manager = new stag_file_manager('/');

    $files_n_folders = $file_manager->scan_directory(array(
        'directory' => '/container/stagons/'
    ));

    $stagons_data = array();

    foreach($files_n_folders['files'] as $file){
        $stagon_main_file = STAG_CONTAINER_DIR.'/stagons/'.$file;

        if(file_exists($stagon_main_file)){
            // Phrase the comment
            $temp_result = stag_phrase_comment::file(
                $stagon_main_file,
                array('StagON Name', 'StagON URI', 'StagON Description', 'Version')
            );

            array_push($stagons_data, $temp_result);
        }
    }
    
    foreach($files_n_folders['directories'] as $directory){
        $stagon_main_file = STAG_CONTAINER_DIR.'/stagons/'.$directory.'/'.$directory.'.php';

        if(file_exists($stagon_main_file)){
            // Phrase the comment
            $temp_result = stag_phrase_comment::file(
                $stagon_main_file,
                array('StagON Name', 'StagON URI', 'StagON Description', 'Version')
            );

            array_push($stagons_data, $temp_result);
        }
    }

    return $stagons_data;
}

function integrate_plugins(){
    // var_dump(discover_plugins());
}