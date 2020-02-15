<?php

// Ignore user abort
ignore_user_abort(true);

// 300 seconds = 5 minutes
ini_set('max_execution_time', 300);

// 	256M
ini_set('memory_limit', '256M');

/** Define ABSPATH as this file's directory */
if(!defined('ABSPATH')) define('ABSPATH', dirname(__FILE__));

require_once ABSPATH.'/includes/lib/file-manager/file-manager.php';
require_once ABSPATH.'/includes/components/core/maintenance/functions.php';

$file_worker = new stag_file_manager('/');

$maintenance_obj = new stag_maintenance_mod($file_worker);

$maintenance_obj->enable();

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
    'overwrite_file'        => TRUE
));

/** Move Index file */
$file_worker->move_file(array(
    'directory'             => '/StagPHP-Framework-master/',
    'file_name'             => 'readme.md',
    'destination_directory' => '/',
    'overwrite_file'        => TRUE
));

$maintenance_obj->disable();

echo json_encode(array(
    'status'        => TRUE,
    'description'   => 'Update installed!',
    'result'        => array(
        'response'      => TRUE
    )
));
unlink(ABSPATH.'/update.php');
exit;