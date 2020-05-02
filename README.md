
# StagPHP - MVC Driven PHP Framework.
StagPHP is is Open Source, Lightweight, Extensible, High Performance, and Secure PHP Framework for Modern Web Applications. It follows the MVC (Model View Controller) architecture.

## Preamble
StagPHP is Open Source, Lightweight, Extensible, High Performance, and Secure PHP Framework for Modern Web Applications. It is compatible with almost all web server that can run PHP, my SQL and Apache. It follows the popular MVC (Model View Controller) Architecture.
1. **Open Source**
StagPHP is an open-source framework. All of its verified StagONS are free and open source. We believe in open-source projects, as the contribution of every single individual matter to us. Join our community and be a part of StagPHP development team.
2. **StagONS**
StagPHP comes built-in with few libraries to ease your work. But, we all know, that might not be just enough. So we have StagONS. It is just like external library packages, similar to plugins. StagONS extends the functionality of StagPHP framework.
3. **Easy to use**
StagPHP is very easy to learn and use for your project. Use built-in libraries and StagONS for smart development. Check out our guide to get started with StagPHP. For PHP experts, we have detailed documentation of core structure and functionalities, and each and every built-in core libraries of StagPHP.

## Directory Structure

StagPHP has following directory structure (Updated on V 1.0.2). We are creating documentation for more insight.
- app - Application Directory
- cache - Auto Generated Cache Directory
- container - Storage Container
- includes - Includes Core Files
	- admin - Super User / Adminstration Files
		- assets
		- controllers
		- views
	- components
		- boot - Boot Up and Shutdown Function
		- core
		- helpers
	- lib - Core Controllers and Library
- index.php

## Naming Convention
Typical, but worth mentioning

|Type |Naming Convention|
|-------------------------------|-------------------------------------|
|File Names |Lower cased separated with dash and group separated with dot (**stag-start.group.php**)|
|Variables |Lower cased separated with underscored (**$file_system**)|
|Global variables |All upper case and underscored (**$GLOBAL_VARIABLE**)|
|Instances variables / Objects |Suffix **_obj** (**$file_operator_obj**)|
|Reserved variables |Prefix **stag_** (**$stag_file_op_obj**)|
|Array |Lower cased separated with underscored (**array('the_key'=>'the_value')**)|
|Constants |All upper case and underscored (**THE_CONSTANT_VAR**)|
|Classes |Camel case / Pascal case (Note that, when using camel case, the initial character is upper case) (**FileOperator**)|
|Methods |Lower cased separated with underscored (**the_function()**)|  

## Reserved Variables and Functions
Must be considered while developing StagPHP application, to avoid conflicts.

|Type |LIST |
|-------------------------------|-------------------------------------|
|Global Reserved Variable |ABSPATH, STAG_VERSION, STAG_INDEX, CURRENT_DOMAIN, REQUEST_URI, EXECUTION_START, APP_VIEW_LOADED, APP_404, STAG_APP_DIR, STAG_CACHE_DIR, STAG_INCLUDES, STAG_ADMIN_DIR, STAG_COMPONENTS_DIR, STAG_LIB_DIR, STAG_ADMIN_CONTROLLERS_DIR, STAG_ADMIN_VIEWS_DIR |
|Reserved Function Names |stag_startup, stag_url_create, stag_url_rewrite, stag_route_junction, stag_add_route, stag_add_redirect, get_home_url, get_current_url, get_current_slug, get_su_panel_url, get_assets_dir_uri, stag_action |

## Update Log

### V 1.0.5 - Beta Build (10-03-2020)
1. App view section removed - as we are working on new concept
2. App Controller menu removed - as are moving towards the integration of StagOns
3. Super Admin Panel navigation menu updated

### V 1.0.4 - Beta Build (20-02-2020)
1. Update logic optimized
2. Super Admin Panel UI modified including navigation
3. Setup Optimized, multiple fields added, to customize framework during installation
4. Core Modules Optimized
5. Folder structure Modified
6. Security enhanced

### V 1.0.3 - Beta Build (10-01-2020)
1. Several minor bugs fixed
2. Backed enqueue logic created
4. Update logic optimized
5. Core code optimized

### V 1.0.2
1. Prefix stag- removed from core folders
2. Object buffer optimized
3. View List Bug Fixed
4. View Edit Page Bug Fixed
5. Application Re-Structure
6. Cache separated into container and cache
7. Core Update Logic Created

### V 1.0.1
1. Complete code auditing, arrangement and cleanup
2. Installation modified
3. DB controller updated
4. noDB support added
5. Bootup enhanced, optimized and secured
6. Update functionality modified
7. Stag SMTP Integration - Work on Progress

### V 1.0.0 - Alpha Build 7
1. Added Static Objects - Phrase Object, CURL Object
2. Update Logic Modified - This release is only for testing
3. SU Panel UI Reset - Bootstrap Reset

### V 1.0.0 - Alpha Build 6
1. Architecture Modified
2. Code Revised
3. Core mySQL DB Controller Modified and Updated
4. Stag Core Update Functionality Added

### V 1.0.0 - Alpha Build 5
1. Code Editor Added
2. Super User Management Updated
3. Stag JDB Updated

### V 1.0.0 - Alpha Build 4
1. Complete Code Revised
2. Super User Management Updated
3. Stag JDB Updated

### V 1.0.0 - Alpha Build 3
1. Super User Session Management Updated
2. Remember Me Fixed
3. Unique Session Fixed

### V 1.0.0 - Alpha Build 2
1. Ace Editor Integrated
2. Code Editor Page Created
3. Page ID Implemented
4. Code Formatted
5. Code optimized

### V 1.0.0 - Alpha Build 1
1. Multiple Functions Created
2. Readme Added

### V 1.0.0
1. Genessis Build