<?php
/**
 * Name:            Stag File Manager (StagPHP Library)
 * Description:     Contains final executable functions
 *                  of the StagPHP File Manager Library.
 *                  This file must be included to load
 *                  the library
 *
 * @package:        StagPHP Library File
 */

/** Stag File Manager Functions */
require_once 'functions.php';

/** Stag file manager 
 * 
 * This class must be initialized with
 * root directory parameters. ABSPATH must
 * be defined, if not used inside the StagPHP
 * framework */
class stag_file_manager extends stag_file_manager_functions
{

/** Constructor sets root directory */
function __construct($root_dir){
    /** Call parent Constructor */
    parent::__construct($root_dir);
}

function get_info($args){
    return parent::get_info($args['path']);
}

function get_file_properties($args){
    /** get file info for processing */
    $file_info = parent::get_info($args['directory'].'/'.$args['file_name']);

    /** Get file properties for a valid file type */
    if(TRUE === $file_info['status'] && 'file' == $file_info['type'])
    return parent::file_properties($file_info['absolute_path']);

    /** Return error for invalid file type */
    return array(
        'status'            => FALSE,
        'type'              => NULL,
        'size'              => NULL,
        'permission'        => NULL,
        'modified_time'     => NULL,
        'absolute_path'     => NULL,
        'description'       => 'Invalid file!'
    );
}

function get_directory_properties($args){
    /** get file info for processing */
    $directory_info = parent::get_info($args['directory']);

    /** Get file properties for a valid file type */
    if(TRUE === $directory_info['status'] && 'directory' == $directory_info['type'])
    return parent::directory_properties($directory_info['absolute_path']);

    /** Return error for invalid file type */
    return array(
        'status'            => FALSE,
        'size'              => NULL,
        'directory_count'   => NULL,
        'file_count'        => NULL,
        'permission'        => NULL,
        'modified_time'     => NULL,
        'absolute_path'     => NULL,
        'description'       => 'Invalid Directory!'
    );
}

function scan_directory($args){
    /** get file info for processing */
    $directory_info = parent::get_info($args['directory']);

    /** Get file properties for a valid file type */
    if(TRUE === $directory_info['status'] && 'directory' == $directory_info['type'])
    return parent::directory_scan($directory_info['absolute_path']);

    /** Return false if directory does not exists */
    return [
        'status'      => FALSE,
        'directories' => NULL,
        'files'       => NULL,
        'description' => 'Invalid Directory!'
    ];
}

function deep_scan_directory($args){
    /** get file info for processing */
    $directory_info = parent::get_info($args['directory']);

    /** Get file properties for a valid file type */
    if(TRUE === $directory_info['status'] && 'directory' == $directory_info['type'])
    return parent::deep_directory_scan($directory_info['absolute_path']);

    /** Return false if directory does not exists */
    return [
        'status'            => FALSE,
        'directory_items'   => NULL,
        'description'       => 'Invalid Directory!'
    ];
}

function create_file($args){
    /** Check the arguments */
    if(empty($args['directory']) || empty($args['file_name']) || empty($args['file_content'])) return [
        'status'        => FALSE,
        'absolute_path' => NULL,
        'description'   => 'Invalid Arguments!'
    ];

    /** Get file info for processing */
    $file_info = parent::get_info($args['directory'].'/'.$args['file_name']);

    /** Create path for the new file */
    $absolute_file_path = $file_info['absolute_path'];

    /** Return if file already exists */
    if(TRUE === $file_info['status']) return [
        'status' => FALSE,
        'absolute_path' => $absolute_file_path,
        'description' => 'Specified file already exists!'
    ];

    /** Get parent directory */
    $parent_directory = parent::get_info($args['directory']);

    /** Create Directory: if directory does not exists */
    if(FALSE === $parent_directory['status']){
        if(isset($args['create_directories']) && TRUE === $args['create_directories']){
            /** Create directory to save file, if directory
             * creation flag is set to true */
            if(FALSE === parent::create_empty_directory($parent_directory['absolute_path'])) return [
                'status' => FALSE,
                'absolute_path' => NULL,
                'description' => 'Failed to create directory for the file!'
            ];
        } else return [
            'status' => FALSE,
            'absolute_path' => NULL,
            'description' => 'Directory does not exists!'
        ];
    }
    
    else if('file' == $parent_directory['type']) return [
        'status' => FALSE,
        'absolute_path' => NULL,
        'description' => 'Invalid directory!'
    ];

    /** Finally save file */
    parent::save_file($absolute_file_path, $args['file_content']);

    /** File updated successfully */
    return [
        'status' => TRUE,
        'absolute_path' => $absolute_file_path,
        'description' => 'File Created!'
    ];
}

function update_file($args){
    /** Check the arguments */
    if(empty($args['directory']) || empty($args['file_name']) || empty($args['file_content'])) return [
        'status'        => FALSE,
        'absolute_path' => NULL,
        'description'   => 'Invalid Arguments!'
    ];

    /** action */
    $action = 'Updated';

    /** Get file info for processing */
    $file_info = parent::get_info($args['directory'].'/'.$args['file_name']);

    if(FALSE === $file_info['status']) {
        if(TRUE === $args['create_file']) $action = 'Created';
        else return [
            'status' => FALSE,
            'absolute_path' => NULL,
            'description' => 'Specified file does not exists!'
        ];
    }

    /** Return false: If relative file specified
     * contains the path of a directory
     * instead of the file */
    else if('directory' == $file_info['type']) return [
        'status' => FALSE,
        'absolute_path' => NULL,
        'description' => 'Specified file path is not valid!'
    ];

    /** Create path for the new file */
    $absolute_file_path = $file_info['absolute_path'];

    /** Get parent directory */
    $parent_directory = parent::get_info($args['directory']);

    /** Create Directory: if directory does not exists */
    if(FALSE === $parent_directory['status']){
        /** Check directory flag */
        if(isset($args['create_directories']) && TRUE === $args['create_directories']){
             /** Create directory to save file */
            if(FALSE === parent::create_empty_directory($parent_directory['absolute_path'])) return [
                'status' => FALSE,
                'absolute_path' => NULL,
                'description' => 'Failed to create directory for the file!'
            ];
        } else return [
            'status' => FALSE,
            'absolute_path' => NULL,
            'description' => 'Directory does not exists!'
        ];
    }

    /** Finally save file */
    parent::save_file($absolute_file_path, $args['file_content']);

    /** File updated successfully */
    return [
        'status' => TRUE,
        'absolute_path' => $absolute_file_path,
        'description' => 'File '.$action.'!'
    ];
}

function copy_file($args){
    /** Check the arguments */
    if(empty($args['directory']) || empty($args['file_name']) || empty($args['destination_directory'])) return [
        'status'        => FALSE,
        'absolute_path' => NULL,
        'description'   => 'Invalid Arguments!'
    ];

    /** action */
    $action = 'copied';

    /** Get source path info for processing */
    $src_file_info = parent::get_info($args['directory'].'/'.$args['file_name']);

    if(FALSE === $src_file_info['status']) return [
        'status'            => false,
        'source_file_path'  => NULL,
        'file_path'         => NULL,
        'description'       => 'Source file not found!'
    ];

    else if('directory' == $src_file_info['type']) return [
        'status'            => false,
        'source_file_path'  => NULL,
        'file_path'         => NULL,
        'description'       => 'Source is not a file!'
    ];

    $absolute_src_file_path = $src_file_info['absolute_path'];

    $dest_dir_info = parent::get_info($args['destination_directory']);

    /** Directory does not exists */
    if(FALSE === $dest_dir_info['status']){
        /** Check directory flag */
        if(isset($args['create_directories']) && TRUE === $args['create_directories']){
            /** Create directory to save file */
           if(FALSE === parent::create_empty_directory($dest_dir_info['absolute_path'])) return [
               'status'             => FALSE,
               'source_file_path'   => NULL,
               'file_path'          => NULL,
               'description'        => 'Failed to create directory for the file!'
           ];
       } else return [
           'status'             => FALSE,
           'source_file_path'   => NULL,
           'file_path'          => NULL,
           'description'        => 'Directory does not exists!'
       ];
    }

    /** Return false: If relative file specified
     * belongs to a file */
    else if('file' == $dest_dir_info['type']) return [
        'status'            => FALSE,
        'source_file_path'  => NULL,
        'file_path'         => NULL,
        'description'       => 'Specified destination directory is not valid directory!'
    ];

    /** Get destination path info for processing */
    if(empty($args['new_file_name'])){
        $absolute_dest_file_path = $dest_dir_info['absolute_path'].'/'.$args['file_name'];
    } else {
        $absolute_dest_file_path = $dest_dir_info['absolute_path'].'/'.$args['new_file_name'];
    }

    /** Create file already exists */
    if(file_exists($absolute_dest_file_path)){
        if(isset($args['overwrite_file']) && TRUE === $args['overwrite_file']) $action = 'copied and overwritten';
        else return [
            'status'            => FALSE,
            'source_file_path'  => NULL,
            'file_path'         => NULL,
            'description'       => 'File already exists!'
        ];
    }

    if(copy($absolute_src_file_path, $absolute_dest_file_path)) return [
        'status'            => true,
        'source_file_path'  => $absolute_src_file_path,
        'file_path'         => $absolute_dest_file_path,
        'description'       => 'File successfully '.$action.'!'
    ];

    else return [
        'status'            => FALSE,
        'source_file_path'  => NULL,
        'file_path'         => NULL,
        'description'       => 'Failed to copy file!'
    ];
}

function move_file($args){
    /** Check the arguments */
    if(empty($args['directory']) || empty($args['file_name']) || empty($args['destination_directory'])) return [
        'status'        => FALSE,
        'absolute_path' => NULL,
        'description'   => 'Invalid Arguments!'
    ];

    /** action */
    $action = 'moved';

    /** Get source path info for processing */
    $src_file_info = parent::get_info($args['directory'].'/'.$args['file_name']);

    if(FALSE === $src_file_info['status']) return [
        'status'            => false,
        'source_file_path'  => NULL,
        'file_path'         => NULL,
        'description'       => 'Source file not found!'
    ];

    else if('directory' == $src_file_info['type']) return [
        'status'            => false,
        'source_file_path'  => NULL,
        'file_path'         => NULL,
        'description'       => 'Source is not a file!'
    ];

    $absolute_src_file_path = $src_file_info['absolute_path'];

    $dest_dir_info = parent::get_info($args['destination_directory']);

    /** Directory does not exists */
    if(FALSE === $dest_dir_info['status']){
        /** Check directory flag */
        if(isset($args['create_directories']) && TRUE === $args['create_directories']){
            /** Create directory to save file */
           if(FALSE === parent::create_empty_directory($dest_dir_info['absolute_path'])) return [
               'status'             => FALSE,
               'source_file_path'   => NULL,
               'file_path'          => NULL,
               'description'        => 'Failed to create directory for the file!'
           ];
       } else return [
           'status'             => FALSE,
           'source_file_path'   => NULL,
           'file_path'          => NULL,
           'description'        => 'Directory does not exists!'
       ];
    }

    /** Return false: If relative file specified
     * belongs to a file */
    else if('file' == $dest_dir_info['type']) return [
        'status'            => FALSE,
        'source_file_path'  => NULL,
        'file_path'         => NULL,
        'description'       => 'Specified destination directory is not valid directory!'
    ];

    /** Get destination path info for processing */
    if(empty($args['new_file_name'])){
        $absolute_dest_file_path = $dest_dir_info['absolute_path'].'/'.$args['file_name'];
    } else {
        $absolute_dest_file_path = $dest_dir_info['absolute_path'].'/'.$args['new_file_name'];
    }

    /** Create file already exists */
    if(file_exists($absolute_dest_file_path)){
        if(isset($args['overwrite_file']) && TRUE === $args['overwrite_file']) $action = 'copied and overwritten';
        else return [
            'status'            => FALSE,
            'source_file_path'  => NULL,
            'file_path'         => NULL,
            'description'       => 'File already exists!'
        ];
    }

    if(parent::alter_file($absolute_src_file_path, $absolute_dest_file_path)) return [
        'status'            => true,
        'source_file_path'  => $absolute_src_file_path,
        'file_path'         => $absolute_dest_file_path,
        'description'       => 'File successfully '.$action.'!'
    ];

    else return [
        'status'            => FALSE,
        'source_file_path'  => NULL,
        'file_path'         => NULL,
        'description'       => 'Failed to copy file!'
    ];
}

function rename_file($args){
    /** Check the arguments */
    if(empty($args['directory']) || empty($args['file_name']) || empty($args['new_file_name'])) return [
        'status'        => FALSE,
        'absolute_path' => NULL,
        'description'   => 'Invalid Arguments!'
    ];

    /** action */
    $action = 'renamed';

    /** Get source path info for processing */
    $src_file_info = parent::get_info($args['directory'].'/'.$args['file_name']);

    if(FALSE === $src_file_info['status']) return [
        'status'            => TRUE,
        'source_file_path'  => NULL,
        'file_path'         => NULL,
        'description'       => 'Source file not found!'
    ];

    else if('directory' == $src_file_info['type']) return [
        'status'            => false,
        'source_file_path'  => NULL,
        'file_path'         => NULL,
        'description'       => 'Source is not a file!'
    ];

    $absolute_src_file_path = $src_file_info['absolute_path'];

    if($args['file_name'] == $args['new_file_name']) return [
        'status'            => FALSE,
        'source_file_path'  => $absolute_src_file_path,
        'file_path'         => $absolute_src_file_path,
        'description'       => 'File names where same!'
    ];

    /** Get destination path info for processing */
    $absolute_dest_file_info = parent::get_info($args['directory'].'/'.$args['new_file_name']);

    /** Create file already exists */
    if(TRUE == $absolute_dest_file_info['status']){
        if(isset($args['overwrite_file']) && TRUE === $args['overwrite_file']) $action = 'renamed and overwritten';
        else return [
            'status'            => FALSE,
            'source_file_path'  => NULL,
            'file_path'         => NULL,
            'description'       => 'File already exists!'
        ];
    }

    $absolute_dest_file_path = $absolute_dest_file_info['absolute_path'];

    if(parent::alter_file($absolute_src_file_path, $absolute_dest_file_path)) return [
        'status'            => TRUE,
        'source_file_path'  => $absolute_src_file_path,
        'file_path'         => $absolute_dest_file_path,
        'description'       => 'File successfully '.$action.'!'
    ];

    else return [
        'status'            => FALSE,
        'source_file_path'  => NULL,
        'file_path'         => NULL,
        'description'       => 'Failed to rename file!'
    ];
}

function delete_file($args){
    /** Check the arguments */
    if(empty($args['directory']) || empty($args['file_name'])) return [
        'status'        => FALSE,
        'absolute_path' => NULL,
        'description'   => 'Invalid Arguments!'
    ];

    /** Get source path info for processing */
    $file_info = parent::get_info($args['directory'].'/'.$args['file_name']);

    if(FALSE === $file_info['status']) return [
        'status' => false,
        'description' => 'File not found!'
    ];

    else if('directory' == $file_info['type']) return [
        'status' => false,
        'description' => 'Invalid file!'
    ];

    if(parent::unlink_file($file_info['absolute_path'])) return [
        'status' => TRUE,
        'description' => 'File deleted!'
    ];

    return [
        'status' => FALSE,
        'description' => 'File is not valid!'
    ];
}

function create_directory($args){
    /** Check the arguments */
    if(empty($args['directory'])) return [
        'status'        => FALSE,
        'description'   => 'Invalid Directory!'
    ];

    /** Get destination path info for processing */
    $path_info = parent::get_info($args['directory']);

    if($path_info['status'] && 'file' == $path_info['type']) return [
        'status' => FALSE,
        'description' => 'Invalid directory!'
    ];

    else if($path_info['status']) return [
        'status' => TRUE,
        'description' => 'Directory already exists!'
    ];

    if(parent::create_empty_directory($path_info['absolute_path'])) return [
        'status' => TRUE,
        'description' => 'Directory created!'
    ];

    return [
        'status' => FALSE,
        'description' => 'Failed to create directory!'
    ];
}

function copy_directory($args){
    /** Check the arguments */
    if(empty($args['directory']) || empty($args['destination_directory'])) return [
        'status'        => FALSE,
        'absolute_path' => NULL,
        'description'   => 'Invalid Arguments!'
    ];

    $merge = $overwrite = TRUE;
        
    /** Get source path info for processing */
    $src_dir_info = parent::get_info($args['directory']);

    if(FALSE === $src_dir_info['status']) return [
        'status' => false,
        'description' => 'Source directory does not exists!'
    ];

    else if('file' == $src_dir_info['type']) return [
        'status' => false,
        'description' => 'Invalid source directory!'
    ];

    $absolute_src_dir_path = $src_dir_info['absolute_path'];

    $src_dir_name = basename($absolute_src_dir_path);

    /** Get destination path info for processing */
    $dest_dir_info = parent::get_info($args['destination_directory'].'/'.$src_dir_name.'/');

    $absolute_dest_dir_path = $dest_dir_info['absolute_path'];

    if($dest_dir_info['status'] && 'file' == $dest_dir_info['type']) return [
        'status' => false,
        'description' => 'Invalid destination directory!'
    ];

    if(isset($args['merge_directory'])) $merge = $args['merge_directory'];

    if(isset($args['overwrite_file'])) $overwrite = $args['overwrite_file'];

    if(parent::directory_child_check($args['directory'], $args['destination_directory'])) return [
        'status' => false,
        'description' => 'Directory cannot be copied inside the same directory!'
    ];

    /** Recursive copy also creates the directory 
     * if required */
    if(parent::recursive_copy($absolute_src_dir_path, $absolute_dest_dir_path, $merge, $overwrite)) return [
        'status'            => TRUE,
        'source_dir_path'   => $absolute_src_dir_path,
        'dir_path'          => $absolute_dest_dir_path,
        'description'       => 'Directory copied!'
    ];

    return [
        'status'            => TRUE,
        'source_dir_path'   => NULL,
        'dir_path'          => NULL,
        'description'       => 'Cannot Copy!'
    ];
}

function move_directory($args){
    /** Check the arguments */
    if(empty($args['directory']) || empty($args['destination_directory'])) return [
        'status'        => FALSE,
        'absolute_path' => NULL,
        'description'   => 'Invalid Arguments!'
    ];

    $merge = $overwrite = TRUE;
        
    /** Get source path info for processing */
    $src_dir_info = parent::get_info($args['directory']);

    if(FALSE === $src_dir_info['status']) return [
        'status' => false,
        'description' => 'Source directory does not exists!'
    ];

    else if('file' == $src_dir_info['type']) return [
        'status' => false,
        'description' => 'Invalid source directory!'
    ];

    $absolute_src_dir_path = $src_dir_info['absolute_path'];

    $src_dir_name = basename($absolute_src_dir_path);

    /** Get destination path info for processing */
    $dest_dir_info = parent::get_info($args['destination_directory'].'/'.$src_dir_name.'/');

    $absolute_dest_dir_path = $dest_dir_info['absolute_path'];

    if($dest_dir_info['status'] && 'file' == $dest_dir_info['type']) return [
        'status' => false,
        'description' => 'Invalid destination directory!'
    ];

    if(isset($args['merge_directory'])) $merge = $args['merge_directory'];

    if(isset($args['overwrite_file'])) $overwrite = $args['overwrite_file'];

    if(parent::directory_child_check($args['directory'], $args['destination_directory'])) return [
        'status' => false,
        'description' => 'Directory cannot be moved inside the same directory!'
    ];

    /** Recursive copy also creates the directory 
     * if required */
    if(parent::recursive_move($absolute_src_dir_path, $absolute_dest_dir_path, $merge, $overwrite)) return [
        'status'            => TRUE,
        'source_dir_path'   => $absolute_src_dir_path,
        'dir_path'          => $absolute_dest_dir_path,
        'description'       => 'Directory copied!'
    ];

    return [
        'status'            => TRUE,
        'source_dir_path'   => NULL,
        'dir_path'          => NULL,
        'description'       => 'Cannot Copy!'
    ];
}

function move_directory_content($args){
    /** Check the arguments */
    if(empty($args['directory']) || empty($args['destination_directory'])) return [
        'status'        => FALSE,
        'absolute_path' => NULL,
        'description'   => 'Invalid Arguments!'
    ];

    $merge = $overwrite = TRUE;
        
    /** Get source path info for processing */
    $src_dir_info = parent::get_info($args['directory']);

    if(FALSE === $src_dir_info['status']) return [
        'status' => false,
        'description' => 'Source directory does not exists!'
    ];

    else if('file' == $src_dir_info['type']) return [
        'status' => false,
        'description' => 'Invalid source directory!'
    ];

    $absolute_src_dir_path = $src_dir_info['absolute_path'];

    /** Get destination path info for processing */
    $dest_dir_info = parent::get_info($args['destination_directory']);

    $absolute_dest_dir_path = $dest_dir_info['absolute_path'];

    if($dest_dir_info['status'] && 'file' == $dest_dir_info['type']) return [
        'status' => false,
        'description' => 'Invalid destination directory!'
    ];

    if(isset($args['merge_directory'])) $merge = $args['merge_directory'];

    if(isset($args['overwrite_file'])) $overwrite = $args['overwrite_file'];

    if(parent::directory_child_check($args['directory'], $args['destination_directory'])) return [
        'status' => false,
        'description' => 'Directory cannot be moved inside the same directory!'
    ];

    /** Recursive copy also creates the directory 
     * if required */
    if(parent::recursive_move($absolute_src_dir_path, $absolute_dest_dir_path, $merge, $overwrite)) return [
        'status'            => TRUE,
        'source_dir_path'   => $absolute_src_dir_path,
        'dir_path'          => $absolute_dest_dir_path,
        'description'       => 'Directory copied!'
    ];

    return [
        'status'            => TRUE,
        'source_dir_path'   => NULL,
        'dir_path'          => NULL,
        'description'       => 'Cannot Copy!'
    ];
}

function rename_directory($args){
    /** Check the arguments */
    if(empty($args['directory']) || empty($args['directory_new_name'])) return [
        'status'        => FALSE,
        'absolute_path' => NULL,
        'description'   => 'Invalid Arguments!'
    ];

    /** Get source path info for processing */
    $src_dir_info = parent::get_info($args['directory']);

    if(FALSE === $src_dir_info['status']) return [
        'status' => false,
        'description' => 'Source directory does not exists!'
    ];

    else if('file' == $src_dir_info['type']) return [
        'status' => false,
        'description' => 'Invalid source directory!'
    ];

    $absolute_src_dir_path = $src_dir_info['absolute_path'];

    $base_name = basename($absolute_src_dir_path);

    $parent_dir = rtrim(str_replace($base_name, '', $absolute_src_dir_path).'/', '/');

    $absolute_dest_dir_path = $parent_dir.'/'.$args['directory_new_name'];

    if($base_name == $args['directory_new_name']) return [
        'status' => TRUE,
        'absolute_path' => $absolute_dest_dir_path,
        'description' => 'Directory old name and new names are same!'
    ];

    if(parent::alter_file($absolute_src_dir_path, $absolute_dest_dir_path)) return [
        'status' => TRUE,
        'absolute_path' => $absolute_dest_dir_path,
        'description' => 'Directory renamed!'
    ];

    else return [
        'status'        => FALSE,
        'absolute_path' => NULL,
        'description'   => 'Invalid Arguments!'
    ];
}

function delete_directory($args){
    /** Check the arguments */
    if(empty($args['directory'])) return [
        'status'        => FALSE,
        'absolute_path' => NULL,
        'description'   => 'Invalid Arguments!'
    ];

    /** Get source path info for processing */
    $path_info = parent::get_info($args['directory']);

    if(FALSE === $path_info['status']) return [
        'status' => TRUE,
        'description' => 'Directory already deleted!'
    ];

    else if('file' == $path_info['type']) return [
        'status' => TRUE,
        'description' => 'Invalid directory!'
    ];

    $dir_path = $path_info['absolute_path'];

    /** Recursive copy also creates the directory 
     * if required */
    parent::recursive_delete($dir_path);

    return [
        'status'            => TRUE,
        'description'       => 'Directory deleted!'
    ];
}

function download_file($args){
    /** Check the arguments */
    if(empty($args['remote_url']) || empty($args['directory']) || empty($args['file_name'])) return [
        'status'        => FALSE,
        'absolute_path' => NULL,
        'description'   => 'Invalid Arguments!'
    ];

    $create_dir = $overwrite = TRUE;

    if(isset($args['create_directories'])) $create_dir = $args['create_directories'];

    if(isset($args['overwrite_file'])) $overwrite = $args['overwrite_file'];

    /** Get destination path info for processing */
    $dir_info = parent::get_info($args['directory']);

    $dir_path = $dir_info['absolute_path'];

    if(FALSE === $dir_info['status']){
        if(TRUE !== $create_dir) return [
            'status' => FALSE,
            'description' => 'Directory does not exists exists!'
        ];

        /** Create directory to save file */
        if(FALSE === parent::create_empty_directory($dir_path)) return [
            'status'             => FALSE,
            'source_file_path'   => NULL,
            'description'        => 'Failed to create directory for the file!'
        ];
    }

    else if('file' == $dir_info['type']) return [
        'status' => false,
        'description' => 'Invalid directory!'
    ];

    /** Get destination path info for processing */
    $final_path_info = parent::get_info($args['directory'].'/'.$args['file_name']);

    if(TRUE === $final_path_info['status'] && 'file' == $final_path_info['type']){
        if(TRUE !== $overwrite) return [
            'status' => TRUE,
            'description' => 'File already exists!'
        ];
    }

    else if('directory' == $final_path_info['type']) return [
        'status' => FALSE,
        'description' => 'Invalid filename specified!'
    ];

    if(parent::curl_download_file($args['remote_url'], $final_path_info['absolute_path'])) return [
        'status' => TRUE,
        'description' => 'File Downloaded!'
    ];

    return [
        'status' => FALSE,
        'description' => 'Failed to Download File!'
    ];
}

function get_remote_file_content($args){
    /** Check the arguments */
    if(empty($args['remote_url'])) return [
        'status'        => FALSE,
        'absolute_path' => NULL,
        'description'   => 'Invalid Arguments!'
    ];

    $content = parent::curl_download_file($args['remote_url'], NULL);

    if(FALSE !== $content) return [
        'status' => TRUE,
        'content' => $content,
        'description' => 'Remote File Content Fetched!'
    ];

    return [
        'status' => FALSE,
        'description' => 'Failed to Fetch Remote File Content!'
    ];
}

function compress_file($args){
    /** Check the arguments */
    if(empty($args['directory']) || empty($args['file_name']) || empty($args['destination_directory'])) return [
        'status'        => FALSE,
        'absolute_path' => NULL,
        'description'   => 'Invalid Arguments!'
    ];

    /** Get source path info for processing */
    $src_dir_info = parent::get_info($args['directory'].'/'.$args['file_name']);

    if(FALSE === $src_dir_info['status']) return [
        'status' => false,
        'description' => 'Source file does not exists!'
    ];

    else if('directory' == $src_dir_info['type']) return [
        'status' => false,
        'description' => 'Invalid source file!'
    ];

    $absolute_src_file_path = $src_dir_info['absolute_path'];

    /** Get source path info for processing */
    $dest_dir_info = parent::get_info($args['destination_directory']);

    /** Directory does not exists */
    if(FALSE === $dest_dir_info['status']){
        /** Check directory flag */
        if(isset($args['create_directories']) && TRUE === $args['create_directories']){
            /** Create directory to save file */
           if(FALSE === parent::create_empty_directory($dest_dir_info['absolute_path'])) return [
               'status'             => FALSE,
               'source_file_path'   => NULL,
               'file_path'          => NULL,
               'description'        => 'Failed to create directory for the file!'
           ];
       } else return [
           'status'             => FALSE,
           'source_file_path'   => NULL,
           'file_path'          => NULL,
           'description'        => 'Directory does not exists!'
       ];
    }

    /** Return false: If relative file specified
     * belongs to a file */
    else if('file' == $dest_dir_info['type']) return [
        'status'            => FALSE,
        'source_file_path'  => NULL,
        'file_path'         => NULL,
        'description'       => 'Specified destination directory is not valid directory!'
    ];

    if(isset($args['zip_file_name'])) $zip_file_name = $args['zip_file_name'].'.zip';
    else $zip_file_name = $args['file_name'].'.zip';

    $absolute_dest_file_path = $dest_dir_info['absolute_path'].'/'.$zip_file_name;

    /** Create file already exists */
    if(file_exists($absolute_dest_file_path) && isset($args['overwrite_file']) && TRUE !== $args['overwrite_file']) return [
        'status'            => FALSE,
        'source_file_path'  => NULL,
        'file_path'         => NULL,
        'description'       => 'File already exists!'
    ];

    parent::create_zip(
        $absolute_dest_file_path,
        array(array(
            'src_file_loc' => $absolute_src_file_path,
            'file_loc'     => $args['file_name']
        ))
    );

    return [
        'status' => TRUE,
        'description' => 'Zip Created!'
    ];
}

function extract_zip($args){
    /** Check the arguments */
    if(empty($args['directory']) || empty($args['zip_file'])) return [
        'status'        => FALSE,
        'absolute_path' => NULL,
        'description'   => 'Invalid Arguments!'
    ];

    /** Get source path info for processing */
    $src_dir_info = parent::get_info($args['directory'].'/'.$args['zip_file']);

    if(FALSE === $src_dir_info['status']) return [
        'status' => false,
        'description' => 'Source file does not exists!'
    ];

    else if('directory' == $src_dir_info['type']) return [
        'status' => false,
        'description' => 'Invalid source file!'
    ];

    $absolute_src_file_path = $src_dir_info['absolute_path'];

    if(isset($args['destination_directory'])) {
        /** Get source path info for processing */
        $dest_dir_info = parent::get_info($args['destination_directory']);

        /** Directory does not exists */
        if(FALSE === $dest_dir_info['status']){
            /** Check directory flag */
            if(isset($args['create_directories']) && TRUE === $args['create_directories']){
                /** Create directory to save file */
                if(FALSE === parent::create_empty_directory($dest_dir_info['absolute_path'])) return [
                    'status'             => FALSE,
                    'source_file_path'   => NULL,
                    'file_path'          => NULL,
                    'description'        => 'Failed to create directory for the file!'
                ];
            } else return [
                'status'             => FALSE,
                'source_file_path'   => NULL,
                'file_path'          => NULL,
                'description'        => 'Directory does not exists!'
            ];
        }

        /** Return false: If relative file specified
         * belongs to a file */
        else if('file' == $dest_dir_info['type']) return [
            'status'            => FALSE,
            'source_file_path'  => NULL,
            'file_path'         => NULL,
            'description'       => 'Specified destination directory is not valid directory!'
        ];
    } else {
        /** Get source path info for processing */
        $dest_dir_info = parent::get_info($args['directory']);
    }

    $absolute_dest_file_path = $dest_dir_info['absolute_path'];

    parent::extract_zip_file($absolute_src_file_path, $absolute_dest_file_path);

    return [
        'status' => TRUE,
        'description' => 'Zip Extracted!'
    ];
}

}