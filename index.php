<?php
/**
 * Name:            Index PHP
<<<<<<< HEAD
 * Version:         1.0.6
 * Description:     All the traffic handled through here.
=======
 * Version:         1.0.4
 * Description:     All traffics are handled through here.
>>>>>>> 906d5642d1ac0b7dcb410e0a004bbfa4e0eaeea5
 *                  It doesn't do anything, but loads up
 *                  the application
 * 
 * @package:        StagPHP Core File
 */

/** Define ABSPATH as this file's directory */
if(!defined('ABSPATH')) define('ABSPATH', dirname(__FILE__));

/** Loads the StagPHP Application Environment */
require_once(ABSPATH.'/includes/components/boot/startup.php');