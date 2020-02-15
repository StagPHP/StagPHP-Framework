<?php

function stag_get_latest_build_version(){
    $repository_url = 'https://raw.githubusercontent.com/StagPHP/StagPHP-Framework/master/';

    // Create new file manger instance
    $file_manager = new stag_file_manager('/');

    // Check is the folder writable
    $content = $file_manager->get_remote_file_content(array(
        'remote_url' => $repository_url.'index.php'
    ));
  
    // Incase error or no content found
    if(TRUE !== $content['status']) return FALSE;
  
    // Phrase the comment
    $result = stag_phrase_comment::file_content($content['content'], array('Version'));
  
    // Returning the results
    if(empty($result)) return FALSE;
    
    /** Return the update version */
    return $result['Version'];
}

function stag_download_latest_build(){
    // Updated File Loc
    $remote_url = "https://github.com/StagPHP/StagPHP-Framework/archive/master.zip";

    // Create new file manger instance
    $file_manager = new stag_file_manager('/');

    // Check is the folder writable
    $response = $file_manager->download_file(array(
        'remote_url'            => $remote_url,
        'directory'             => '/cache/updates/',
        'file_name'             => 'stag.zip',
        'create_directories'    => TRUE,
        'overwrite_file'        => TRUE
    ));

    if(TRUE === $response['status']) return TRUE;

    return FALSE;
}

function stag_is_update_available(){
    /** Get latest StagPHP version */
    $version =  stag_get_latest_build_version();

    if(!$version) return array(
        false,
        $version
    );

    /** Phrase latest version into array */
    $latest_version = explode('.', $version);
  
    /** Phrase Current version into array */
    $current_version = explode('.', STAG_VERSION);
  
    /** Check Major Version */
    if((int)$latest_version[0] > (int)$current_version[0]) return array(
        true,
        $version
    );
  
    /** Check Sub Version */
    if((int)$latest_version[1] > (int)$current_version[1]) return array(
        true,
        $version
    );
  
    /** Check Build Version */
    if((int)$latest_version[2] > (int)$current_version[2]) return array(
        true,
        $version
    );
  
    /** No Update Available */
    return array(
        false,
        $version
    );
}

function stag_check_update_requirements(){
    /** File Operator Object */
    $file_worker = new stag_file_manager('/');

    /** Create cache directory if does not exists */
    $file_worker->create_directory(array(
        'directory' => '/cache'
    ));

    /** Check cache directory */
    $response = $file_worker->get_info(array(
        'path' => '/cache'
    ));

    if(TRUE !== $response['is_writeable']) return FALSE;

    /** Cache Folder */
    $response = $file_worker->get_info(array(
        'path' => '/includes'
    ));

    if(TRUE !== $response['is_writeable']) return FALSE;

    /** Index File */
    $response = $file_worker->get_info(array(
        'path' => 'index.php'
    ));

    if(TRUE !== $response['is_writeable']) return FALSE;

    return TRUE;
}

function stag_backup_includes(){
    /** File Operator Object */
    $file_worker = new stag_file_manager('/');

    $maintenance_obj = new stag_maintenance_mod($file_worker);

    $date = 

    /** Move original directory */
    $response = $file_worker->copy_directory(array(
        'directory'             => '/includes/',
        'destination_directory' => '/cache/backup/stag-core/',
        'merge_directory'       => TRUE,
        'overwrite_file'        => TRUE
    ));

    if(TRUE === $response['status']) return TRUE;

    return FALSE;
}

function stag_extract_latest_build(){
    /** File Operator Object */
    $file_worker = new stag_file_manager('/');

    /** Move original directory */
    $result = $file_worker->extract_zip(array(
        'directory'             => '/cache/updates/',
        'zip_file'              => 'stag.zip',
        'destination_directory' => '/',
        'overwrite_file'        => TRUE
    ));

    if(TRUE === $result['status']) return TRUE;

    return FALSE;
}