<?php
/**
 * Name:            Index PHP
 * Version:         1.0.6
 * Description:     All the traffic handled through here.
 *                  It doesn't do anything, but loads up
 *                  the application
 * 
 * @package:        StagPHP Core File
 */

/** Define ABSPATH as this file's directory */
if(!defined('ABSPATH')) define('ABSPATH', dirname(__FILE__));

/** Loads the StagPHP Application Environment */
require_once(ABSPATH.'/includes/components/boot/startup.php');