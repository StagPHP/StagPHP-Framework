<?php
/**
 * Name:            StagPHP Get URLs Helper Functions
 * Description:     This file contains functions related to
 *                  retrieve URLs
 * 
 * @package:        StagPHP Core File
 */

/** Get home URL
 * 
 * @return
 *    -> URL as a String
 *    -> FALSE - Incase HOME_URL is not set*/
function get_home_url(){
    if (defined('STAG_INDEX')) return STAG_INDEX;
    return FALSE;
}

/** Get current URL
 * 
 * @return
 *    -> URL as a String
 *    -> FALSE - Incase HOME_URL and REQUEST_URI is not set*/
function get_current_url(){
    return CURRENT_DOMAIN.REQUEST_URI;
}

/** Get current slug */
function get_current_slug(){
    /** Get home url */
    $home_url = get_home_url();
    
    /** Get current url */
    $current_url = get_current_url();
    
    /** Remove domain and return slug */
    return str_replace($home_url, '', $current_url);
}

/** Get admin panel URL
 * 
 * @return
 *    -> URL as a String
 *    -> FALSE - Incase HOME_URL and ADMIN_PANEL_SLUG is not set*/
function get_admin_panel_url(){
    if (defined('STAG_INDEX') && defined('ADMIN_PANEL_SLUG'))
    return STAG_INDEX.'/'.ADMIN_PANEL_SLUG;

    /** Return FALSE if Stag index and
     * su slug not defined */
    return FALSE;
}

/** Function Get Assets Directory URL
 * 
 * @param
 *    -> Folder name where assets directory is stored
 * 
 * @return
 *    -> URL as a String
 *    -> FALSE - Incase HOME_URL is not set*/
function get_assets_dir_uri($folder_name = null, $is_backend = FALSE){
    if($is_backend) {
        if(defined('STAG_INDEX'))
        return STAG_INDEX.'/includes/admin/assets';

        /** Return FALSE if Stag index is not defined */
        return FALSE;
    }
    else {
            /** 
         * If folder name is set - return assets dir URL
         * which is inside that folder. */
        if (!empty($folder_name) && is_dir(STAG_APP_DIR.'/'.$folder_name))
        return get_home_url().'/stag-app'.$folder_name;

        /** 
         * If folder name is not set - return default assets
         * dir URL. */
        return get_home_url() . '/stag-app/assets';
    }
}