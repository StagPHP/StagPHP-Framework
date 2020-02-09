<?php
/**
 * Name:            CLI Commands (StagPHP Library)
 * Description:     Contains several global defined variable
 *
 * @package:        StagPHP Library File
 */

/** 
 * This functions makes scripts
 * executable in background. */
function stag_cli_execute($cmd) { 
    /** Execute in Windows Environment */
    if (substr(php_uname(), 0, 7) == "Windows") pclose(popen("start /B ". $cmd, "r"));  

    /** Execute in Linux Environment */
    else exec($cmd . " > /dev/null &");   
} 