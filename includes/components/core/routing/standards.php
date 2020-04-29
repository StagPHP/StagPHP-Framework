<?php
/**
 * Name:            StagPHP Routing Standards
 * Description:     This file contains functions related
 *                  to the routing standards
 * 
 * @package:        StagPHP Core File
 */

/** Get Rewrite base */
function stag_get_rewrite_base(){
  /** Current Directory URI
   *  Convert Directory URI to Directory URL */
  $full_root = str_replace('\\', '/', realpath(__DIR__));

  /** Get Document URL */
  $doc_root = rtrim($_SERVER['DOCUMENT_ROOT'].'/', '/').'/';

  /** Removing Document Root from Directory URL */
  $string_array = explode($doc_root, $full_root)[1];

  /** Creating array of path elements present in Directory URL
   *  Reversing the created path array */
  $path_array = array_reverse(explode('/', $string_array));

  /** Removing last three elements of array
   *  Re-Reversing the array to original state */
  $path_array = array_reverse(array_slice($path_array, 4));

  /** Creating Rewrite base variable starting with forward slash '/' */
  $rewrite_base = '/';

  /** looping through the array and creating final rewrite base */
  foreach($path_array as $slug) if($slug) $rewrite_base = $rewrite_base.$slug.'/';

  /** Return the final rewrite base */
  return $rewrite_base;
}

/** StagPHP Re-Structure and Rewrite URL
 * 
 * This function contains URL Rewrite logic 
 *      -> Removes extra forward slash
 *      -> Add Missing Forward Slash
 *      -> Phrase URL */
function stag_structure_url(){
  /** Get The Domain */
  $domain = (isset($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'];
  
  /** Define Global Variable Current Domain */
  if(!defined('CURRENT_DOMAIN')) define('CURRENT_DOMAIN', $domain);
  
  /** Get the URL path without query */
  $request_uri = strtok($_SERVER['REQUEST_URI'], '?');
  
  /** Define Global Variable Request URI */
  if(!defined('REQUEST_URI')) define('REQUEST_URI', $request_uri);
  
  /** Get Query Parameter if any */
  $query = parse_url($domain . $_SERVER['REQUEST_URI'], PHP_URL_QUERY);
  
  /** Regex Expression
   * Pattern for repeating forward slash */
  $pattern = '/(\/{2,})/';
  
  /** Check if there is no forward slash at the end
   * or hash or repeating forward slashes */
  if (substr($request_uri, -1) !== '/' || preg_match($pattern, $request_uri)) {
    /** Right Trim from forward slash and add 
     * forward slash */
    $request_url = rtrim($request_uri . '/', '/') . '/';
    
    /** Remove forward slash repetition in between
     * the request URL String */
    $request_url = preg_replace($pattern, '/', $request_url);
    
    /** Create final URL */
    $full_url = $domain . $request_url;
    
    /** Add Query String */
    if ($query) $full_url .= '?' . $query;
    
    /** Get the query string separately and redirect to new URL */
    header("Location: " . $full_url);
    exit;
  }
}

/** StagPHP Create Index/Home URL
 * 
 * This function creates index/home URL for StagPHP
 *      -> Create Index URL as per directory structure */
function stag_create_index_url(){
  /** Setting Index
   * 
   * Run this IF Statement - If Index is not set or
   * not defined */
  if(!defined('STAG_INDEX')){
    /** Defining local Index variable */
    $index = '';
    
    /** Get directory of this executing file */
    $dir = __DIR__;
    
    /** Get Current directory and change backward slash 
     * to forward slash */
    $dir_uri = str_replace('\\', '/', realpath($dir));
    
    /** Get the current domain from global current
     * domain Variable */
    $domain = CURRENT_DOMAIN;
    
    /** Get currently executing directory */
    $doc_root = rtrim($_SERVER['DOCUMENT_ROOT'] . '/', '/') . '/';
    
    /** Combine domain with document root
     * to create absolute path
     * 
     * Execution: substr('.../dir/cyz-inc/comp/routing', (strlen(.../dir/) - 1));
     * Result:    https://stagphp.dev/cyz-inc/comp/routing */
    $domain .= substr($dir_uri, (strlen($doc_root) - 1));
    
    /** Removing extra sub directories */
    $path_array = array_reverse(explode('/', $domain));
    $path_array = array_reverse(array_slice($path_array, 4));
    
    /** Creating final Index */
    foreach ($path_array as $slug) $index .= $slug . '/';
    
    /** Removing trailing forward slash */
    $index = rtrim($index, '/');
    
    /** Define Index */
    define('STAG_INDEX', $index);
  }
}