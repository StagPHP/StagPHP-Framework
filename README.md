# StagPHP - MVC Driven PHP Framework.
StagPHP is a minimalistic build open source PHP Framework for all types of modern application. It follows the MVC (Model View Controller) architecture.

## Preamble
StagPHP is create all types of websites to super powerful web applications. It has minimal inbuilt functionality. Every functionality is carefully selected to just provide a bare bone-structure for your project. Thus it is minimalistic. Minimalistic framework structure low server resource and provide better performance to end-user.
StagPHP needs no extra juice! It is compatible with almost all web server as it requires Apache and PHP to run. Optionally mySQL (or any other database). It is lightweight, so any LAMP server can run StagPHP.
StagPHP functionality can be extended by using StagONS. It is just like addons/plugins AKA (also known as) external controllers. You can install official, self-created or 3rd party StagONS for your project. It makes your application modular. It is full featured framework and supports export, import, editing and update functionality directly from SU (Super User) Panel.
StagPHP is secured by default. But you can follow the steps listed below for better security
- Enable Automatic Updates
- Use VPS (Virtual Private Server) for hosting
- Use strong password for SU Account
- Do Not Install 3rd Party (UnTrusted) StagONS

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
	- componets
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

### V 1.0.1 - Beta Build (10-01-2020)
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