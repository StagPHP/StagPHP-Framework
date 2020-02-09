<?php

function stag_initialize_core_update(){
    // Start Session
    if(session_status() == PHP_SESSION_NONE) session_start();

    /** File Operator Object */
    $file_worker = new stag_file_manager('/');

    /** Copy config file */
    $file_copied = $file_worker->copy_file(array(
        'directory'             => '/includes/components/core/update-management/core/init.php',
        'file_name'             => 'update.daemon.php',
        'destination_directory' =>'/',
        'create_directories'    => TRUE,
        'new_file_name'         => 'update.php',
        'overwrite_file'        => TRUE
    ));

    if(TRUE !== $file_copied['status']) return;

    $_SESSION['stag_home_url'] = get_home_url().'/update.php';
    $_SESSION['stag_core_update_status'] = 'update-started';

    header("Location: ".get_home_url().'/update.php');
    exit;
}