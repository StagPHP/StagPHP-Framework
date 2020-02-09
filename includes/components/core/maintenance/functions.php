<?php

class stag_maintenance_mod{
  private $file_manager;

  function __construct($file_worker){
    $this->file_manager = $file_worker;
  }

  function enable(){
    $file_worker = $this->file_manager;

    /** Rename original index file */
    $result = $file_worker->rename_file(array(
      'directory'             => '/',
      'file_name'             => 'index.php',
      'new_file_name'         => 'index.php.backup',
      'overwrite_file'        => TRUE
    ));

    if(TRUE !== $result['status']) return FALSE;

    // Copy and place maintenance file content in index.php
    $result = $file_worker->copy_file(array(
      'directory'             => '/includes/admin/views/utils/',
      'file_name'             => 'maintenance.php',
      'destination_directory' => '/',
      'new_file_name'         => 'index.php',
      'create_directories'    => FALSE,
      'overwrite_file'        => TRUE
    ));

    if(TRUE === $result['status']) return TRUE;

    return FALSE;
  }

  function disable(){
    $file_worker = $this->file_manager;

    /** Rename original index file */
    $result = $file_worker->rename_file(array(
      'directory'             => '/',
      'file_name'             => 'index.php.backup',
      'new_file_name'         => 'index.php',
      'overwrite_file'        => TRUE
    ));

    if(TRUE === $result['status']) return TRUE;

    return FALSE;
  }
}