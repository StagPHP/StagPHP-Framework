<?php

// Ignore user abort
ignore_user_abort(true);

// Start Session
if(session_status() == PHP_SESSION_NONE) session_start();

// 300 seconds = 5 minutes
ini_set('max_execution_time', 300);

// 	256M
ini_set('memory_limit', '256M');

/** Define ABSPATH as this file's directory */
if(!defined('ABSPATH')) define('ABSPATH', dirname(__FILE__));

require_once ABSPATH.'/includes/lib/file-manager/file-manager.php';
require_once ABSPATH.'/includes/components/core/maintenance/functions.php';

if('update-started' == $_SESSION['stag_core_update_status']){
    /** File Operator Object */
    $file_worker = new stag_file_manager('/');

    $maintenance_obj = new stag_maintenance_mod($file_worker);

    $maintenance_obj->enable();

    /** Move original directory */
    $result = $file_worker->copy_directory(array(
        'directory'             => '/includes/',
        'destination_directory' => '/cache/backup/stag-core/',
        'merge_directory'       => TRUE,
        'overwrite_file'        => TRUE
    ));

    if(TRUE === $result['status']){
        $_SESSION['stag_core_update_status'] = 'backup-completed';
        header("Location: ".$_SESSION['stag_home_url']);
        exit;
    }

    unlink(ABSPATH.'/update.php');
    exit;
}

else if('backup-completed' == $_SESSION['stag_core_update_status']){
    /** File Operator Object */
    $file_worker = new stag_file_manager('/');

    /** Move original directory */
    $result = $file_worker->extract_zip(array(
        'directory'             => '/cache/updates/',
        'zip_file'              => 'stag.zip',
        'destination_directory' => '/',
        'overwrite_file'        => TRUE
    ));

    if(TRUE === $result['status']){
        $_SESSION['stag_core_update_status'] = 'extraction-completed';
        header("Location: ".$_SESSION['stag_home_url']);
        exit;
    }

    unlink(ABSPATH.'/update.php');
    exit;
}

else if('extraction-completed' == $_SESSION['stag_core_update_status']){
    /** File Operator Object */
    $file_worker = new stag_file_manager('/');

    /** Delete Directory */
    $file_worker->delete_directory(array('directory' => '/includes/'));

    /** Move extracted directory */
    $file_worker->move_directory(array(
        'directory'             => '/StagPHP-Framework-master/includes/',
        'destination_directory' => '/',
        'merge_directory'       => TRUE,
        'overwrite_file'        => TRUE
    ));

    /** Move Index file */
    $file_worker->move_file(array(
        'directory'             => '/StagPHP-Framework-master/',
        'file_name'             => 'index.php',
        'destination_directory' => '/',
        'new_file_name'         => 'index.php.backup',
        'overwrite_file'        => TRUE
    ));

    /** Delete StagPHP-master Folder */
    $response = $file_worker->delete_directory(array(
        'directory' => '/StagPHP-Framework-master/'
    ));

    /** Delete stag.zip Folder */
    $response = $file_worker->delete_file(array(
        'directory' => '/cache/updates/',
        'file_name' => 'stag.zip'
    ));

    $maintenance_obj = new stag_maintenance_mod($file_worker);

    $maintenance_obj->disable();

    unlink(ABSPATH.'/update.php');
    exit;
}