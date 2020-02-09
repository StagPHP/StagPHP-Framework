<?php
/**
 * Name:            StagPHP Error Reporting Functions
 * Description:     This file contains functions related to Error Reporting
 * 
 * @package:        StagPHP Core File
 */

/**
 * Enable Error Reporting
 * 
 * Using PHP default functions for logging errors
 * into a file */
function stag_error_reporting($error_message, $core_errors = false){
    // path of the log file where errors need to be logged 
    $application_log_file = STAG_CACHE_DIR.'/logs/errors/application/errors.log'; 
    
    // setting error logging to be active 
    ini_set("log_errors", TRUE);  
    
    // setting the logging file in php.ini 
    ini_set('error_log', $application_log_file); 
    
    // logging the error 
    error_log($error_message);
}