<?php
/**
 * Name:            Stag File Manager Functions
 * Description:     Contains core functions of the StagPHP
 *                  File Manager Library
 *
 * @package:        StagPHP Library File
 */

/** Stag file manager Base Functions */
class stag_file_manager_functions
{

/** Root dir path for all operations */
private $root_dir_path;

/** Quick Scan -> stores total file count */
private $file_count;

/** Quick Scan -> stores total directory count */
private $directory_count;

/** Deep scan root directory */
private $deep_scan_root;

/** Constructor sets root directory */
function __construct($root_dir){
    /** Remove extra forward slash from right */
    $root_dir = rtrim($root_dir.'/', '/');

    if($root_dir) $this->root_dir_path = ABSPATH.$root_dir;
    else $this->root_dir_path = ABSPATH;
}

/** Create Absolute Path */
protected function create_abs_path($relative_path){
    /** Remove unnecessary slashes from the
     * relative path */
    $relative_path = preg_replace('(\/{2,})', '/', $this->root_dir_path.'/'.$relative_path);

    /** Remove extra forward slash from right
     * and create absolute path */
    return rtrim($relative_path.'/', '/');
}

/** Get information related to the path */
protected function get_info($relative_path){
    /** Create absolute path */
    $absolute_path = $this->create_abs_path($relative_path);

    /** Is Writeable Flag */
    $is_writeable = FALSE;

    /** Clears the file status cache */
    clearstatcache();

    /** Checks whether the absolute path exists */
    if(file_exists($absolute_path)){
        /** Check if the file or directory writable */
        if(is_writable($absolute_path)) $is_writeable = TRUE;

        /** Checks whether the absolute path belongs to
         * a file or a directory */
        if(is_file($absolute_path)) return [
            'status'        => TRUE,
            'type'          => 'file',
            'absolute_path' => $absolute_path,
            'is_writeable'  =>  $is_writeable,
            'description'   => 'Relative path belongs to a file!'
        ];

        /** If absolute path belongs to a directory */
        else return [
            'status'        => TRUE,
            'type'          => 'directory',
            'absolute_path' => $absolute_path,
            'is_writeable'  => $is_writeable,
            'description'   => 'Relative path belongs to a directory!'
        ];
    }

    /** Return false if does not exists */
    return [
        'status'        => FALSE,
        'type'          => NULL,
        'absolute_path' => $absolute_path,
        'is_writeable'  => NULL,
        'description'   => 'Relative path do not belongs to a directory or file!'
    ];
}

/** Get file properties */
protected function file_properties($absolute_path){
    /** Clears the file status cache */
    clearstatcache();

    /** Get file mime type */
    $file_type = mime_content_type($absolute_path);

    /** get file size */
    $file_size = filesize($absolute_path);

    /** Get file permission */
    $file_permission = substr(sprintf('%o', fileperms($absolute_path)), -4);

    /** Last modified */
    $file_modified_time = date("Y-m-d H:i:s", filemtime($absolute_path));

    /** Return file property */
    return [
        'status'            => TRUE,
        'type'              => $file_type,
        'size'              => $file_size,
        'permission'        => $file_permission,
        'modified_time'     => $file_modified_time,
        'absolute_path'     => $absolute_path,
        'description'       => 'File properties fetched!'
    ];
}

/** Helper Function: Quickly scan directory */
protected function quick_scan($absolute_path){
    $size = 0;

    foreach (glob(rtrim($absolute_path, '/').'/*', GLOB_NOSORT) as $each) {
        if(is_file($each)){
            $size += filesize($each);
            $this->file_count++;
        } else {
            $size += $this->quick_scan($each);
            $this->directory_count++;
        }
    }

    return $size;
}

protected function get_parent_directory($absolute_path){
    return rtrim(str_replace(basename($absolute_path), '', $absolute_path).'/', '/');
}

/** Get directory properties */
protected function directory_properties($absolute_path){
    /** Clears the file status cache */
    clearstatcache();

    /** Get file permission */
    $directory_permission = substr(sprintf('%o', fileperms($absolute_path)), -4);

    /** Reset directory count */
    $this->directory_count = 0;

    /** Reset file count */
    $this->file_count = 0;

    /** Quick scan directory 
     * returns: directory size
     * Sets: directory and file count */
    $directory_size = $this->quick_scan($absolute_path);

    /** Last modified */
    $directory_modified_time = date("Y-m-d H:i:s", filemtime($absolute_path.'.'));

    /** Return file property */
    return [
        'status'            => TRUE,
        'size'              => $directory_size,
        'directory_count'   => $this->directory_count,
        'file_count'        => $this->file_count,
        'permission'        => $directory_permission,
        'modified_time'     => $directory_modified_time,
        'absolute_path'     => $absolute_path,
        'description'       => 'Directory properties fetched!'
    ];
}

/** Single level directory scan */
protected function directory_scan($absolute_path){
    /** Defining blank array */
    $directories = $files = array();

    /** Default PHP function to scan directory */
    $response = scandir($absolute_path);

    /** Loop response and create separate arrays for directory and files */
    foreach($response as $key => $value) if(!in_array($value, array(".",".."))){
        /** Create array of directories */
        if(is_dir($absolute_path.'/'.$value)) array_push($directories, $value);

        // Create array of files
        else array_push($files, $value);
    }
    
    /** Return the list */
    return array(
        'status'      => TRUE,
        'directories' => $directories,
        'files'       => $files
    );
}

/** Helper Function: Recursive directory scan */
protected function recursive_directory_scan($absolute_path){
    /** Directories to store nested directory */
    $directories = array();

    /** Directories to store file structure */
    $files = array();

    /** Default PHP function to scan directory */
    $items_array = scandir($absolute_path);
    
    /** Loop entities */
    foreach($items_array as $item) if(!in_array($item, array(".",".."))){
        /** Remove unnecessary slashes from the
         * relative path */
        $absolute_path_of_item = preg_replace('(\/{2,})', '/', $absolute_path.'/'.$item);

        /** Create relative path */
        $relative_path = str_replace($this->deep_scan_root, '', $absolute_path_of_item);

        /** Check is directory */
        if(is_dir($absolute_path_of_item)){
            $temp_array = array(
                'type'          => 'folder',
                'name'          => $item,
                'relative_path' => $relative_path.'/',
                'sub_directory' => $this->recursive_directory_scan($absolute_path_of_item)
            );

            array_push($directories, $temp_array);
        } else {
            $file_array = array(
                'type'          => 'file',
                'name'          => $item,
                'relative_path' => $relative_path,
            );

            array_push($files, $file_array);
        }
    }

    /** Return directory structure */
    return array_merge($directories, $files);
}

/** Deep scan directory for all the files and folder */
protected function deep_directory_scan($absolute_path){
    /** Clears the file status cache */
    clearstatcache();

    /** Set deep scan root */
    $this->deep_scan_root = $absolute_path;

    /** Recursively scan directory */
    return array(
        'status'            => TRUE,
        'directory_items'   => $this->recursive_directory_scan($absolute_path)
    );
}

/** Create nested directory */
protected function create_empty_directory($absolute_path){
    /** Attempts to create the nested directories
     * specified by the absolute_path */
    if(TRUE === @mkdir($absolute_path, 0777, TRUE)) return TRUE;

    /** Return FALSE on failure */
    return FALSE;
}

/** Create file */
protected function save_file($absolute_path, $content){
    /** Creates a file if does not exists
     * and return TRUE on success */
    if(TRUE === @file_put_contents($absolute_path, $content, LOCK_EX)) return TRUE;

    /** Return FALSE on failure */
    return FALSE;
}

/** Rename File ~ Move File */
protected function alter_file($src_path, $dst_path){
    /** Rename or move file and return
     * TRUE on success */
    if(TRUE === @rename($src_path, $dst_path)) return TRUE;

    /** Return FALSE on failure */
    return FALSE;
}

/** Unlink File */
protected function unlink_file($absolute_path){
    if(TRUE === @unlink($absolute_path)) return TRUE;

    return FALSE;
}

protected function directory_child_check($src_rel_path, $dst_rel_path){
    /** Remove extra forward slash from right */
    $src_rel_path = '/'.rtrim($src_rel_path.'/', '/').'/';

    $src_rel_path = preg_replace('(\/{2,})', '/', $src_rel_path);

    $src_rel_array = explode('/', $src_rel_path);

    /** Remove extra forward slash from right */
    $dst_rel_path = '/'.rtrim($dst_rel_path.'/', '/').'/';

    $dst_rel_path = preg_replace('(\/{2,})', '/', $dst_rel_path);

    $des_rel_array = explode('/', $dst_rel_path);

    if($src_rel_array[1] == $des_rel_array[1]) return TRUE;
    return FALSE;
}

protected function recursive_copy($src_path, $dst_path, $merge, $overwrite){
    // open the source directory 
    $dir = opendir($src_path);

    $destination_dir_exists = file_exists($dst_path);
  
    // Make the destination directory if not exist
    if($destination_dir_exists && TRUE !== $merge) return FALSE;

    if(FALSE === $destination_dir_exists) @mkdir($dst_path, 0777, TRUE);
  
    // Loop through the files in source directory 
    while(false !== ($file = readdir($dir))) if(($file != '.') && ($file != '..')){  
        if(is_dir($src_path.'/'.$file)){
            if(file_exists($dst_path.'/'.$file) && TRUE !== $merge) return FALSE;

            $this->recursive_copy($src_path.'/'.$file, $dst_path.'/'.$file, $merge, $overwrite);
        } else {
            if(file_exists($dst_path.'/'.$file) && TRUE !== $overwrite) continue;
            
            @copy($src_path.'/'.$file, $dst_path.'/'.$file);
        }
    }
  
    // Close directory
    closedir($dir);

    return TRUE;
}

protected function recursive_move($src_path, $dst_path, $merge, $overwrite){
    // open the source directory 
    $dir = opendir($src_path);

    $destination_dir_exists = file_exists($dst_path);
  
    // Make the destination directory if not exist
    if($destination_dir_exists && TRUE !== $merge) return FALSE;

    if(FALSE === $destination_dir_exists) @mkdir($dst_path, 0777, TRUE);
  
    // Loop through the files in source directory 
    while(false !== ($file = readdir($dir))) if(($file != '.') && ($file != '..')){  
        if(is_dir($src_path.'/'.$file)){
            if(file_exists($dst_path.'/'.$file) && TRUE !== $merge) return FALSE;

            $this->recursive_move($src_path.'/'.$file, $dst_path.'/'.$file, $merge, $overwrite);
        } else {
            if(file_exists($dst_path.'/'.$file) && TRUE !== $overwrite) continue;
            
            @rename($src_path.'/'.$file, $dst_path.'/'.$file);
        }
    }
  
    // Close directory
    closedir($dir);

    // Remove this directory
    rmdir($src_path);

    return TRUE;
}

protected function recursive_delete($absolute_path){
    /** Open the source directory */
    $dir = opendir($absolute_path);
  
    // Loop through the files in source directory 
    while(false !== ($file = readdir($dir))) if(($file != '.') && ($file != '..')){ 
        /** Delete directory */
        if(is_dir($absolute_path.'/'.$file)) $this->recursive_delete($absolute_path.'/'.$file);

        /** Unlink file */
        else @unlink($absolute_path.'/'.$file);
    }


    // Close directory
    closedir($dir);

    // Remove this directory
    rmdir($absolute_path);
}

protected function curl_download_file($remote_url, $absolute_path){
    /** Download file flag */
    $download_file = FALSE;

    /** Check for provided absolute path */
    if(!empty($absolute_path)){
        $file = @fopen($absolute_path, "w");

        if(FALSE === $file) return FALSE;

        $download_file = TRUE;
    }

    // Get The Zip File From Server
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $remote_url);
    curl_setopt($curl, CURLOPT_FAILONERROR, true);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_AUTOREFERER, true);
    curl_setopt($curl, CURLOPT_BINARYTRANSFER,true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); 
    if($download_file) curl_setopt($curl, CURLOPT_FILE, $file);
    $result = curl_exec($curl);
    curl_close($curl);

    if(FALSE === $result) return FALSE;
    else {
        if($download_file) return TRUE;
        else return $result;
    }
}

protected function create_zip($zip_location, $absolute_files){
    $zip = new ZipArchive;
    if($zip->open($zip_location, (ZipArchive::CREATE | ZipArchive::OVERWRITE)) === TRUE){
        foreach($absolute_files as $absolute_file){
            $zip->addFile(
                $absolute_file['src_file_loc'],
                $absolute_file['file_loc']
            );
        }
    
        // All files are added, so close the zip file.
        $zip->close();
    }
}

protected function extract_zip_file($zip_location, $extract_location){
    $zip = new ZipArchive;
    if($zip->open($zip_location)){
        $zip->extractTo($extract_location);
        $zip->close();
    }
}
}