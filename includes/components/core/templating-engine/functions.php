<?php
/**
 * Name:            StagPHP Template Functions
 * Description:     This file contains functions related to Template
 * 
 * @package:        StagPHP Core File
 */

function enqueue_css_backend($data_array){
    GLOBAL $STAG_MEM_CACHE;

    $valid_priority = array('high', 'normal', 'low');
    
    if(!isset($data_array['name']) || !isset($data_array['relative_url']) || !isset($data_array['version'])) return;

    if(!isset($data_array['priority'])) $priority = 'normal';
    else $priority = $data_array['priority'];

    if(!in_array($priority, $valid_priority)) return;

    $resource_dir = get_assets_dir_uri(NULL, TRUE);

    $STAG_MEM_CACHE->add('css-backend', $data_array['name'], array(
        'relative_url'  => $resource_dir.$data_array['relative_url'],
        'version'       => 'v4.3.1',
        'priority'      => $priority
    ));
}

function enqueue_js_backend($data_array){
    GLOBAL $STAG_MEM_CACHE;
    
    if(!isset($data_array['name']) || !isset($data_array['relative_url'])) return;

    if(!isset($data_array['async']) && TRUE === $data_array['async']) $async = TRUE;
    else $async = FALSE;

    $resource_dir = get_assets_dir_uri(NULL, TRUE);

    $STAG_MEM_CACHE->add('js-backend', $data_array['name'], array(
        'relative_url'  => $resource_dir.$data_array['relative_url'],
        'version'       => 'v4.3.1',
        'async'         => $async
    ));
}

function stag_get_enqueued_css_backend(){
    GLOBAL $STAG_MEM_CACHE;

    $all_data_sets = $STAG_MEM_CACHE->get_data_set('css-backend');

    $result_array = array();

    foreach($all_data_sets as $key => $data_set)
    foreach($data_set as $key => $value)
    switch($value['priority']){
        case 'normal':
            /** Creating Synchronous Stylesheet 1 Array */
            if(!isset($normal_priority_array)) $normal_priority_array = array();
            /** Creating Stylesheet HTML link tag */
            $stylesheet = '<link rel="stylesheet" id="'.$key.'" href="'.$value['relative_url'].'?ver='.$value['version'].'" type="text/css" media="all"/>';
            /** Pushing array */
            array_push($normal_priority_array, $stylesheet);
            break;
        case 'high':
            /** Creating Priority 2 Array */
            if(!isset($high_priority_array)) $high_priority_array = array();
            /** Creating Stylesheet HTML link tag */
            $stylesheet = '<link rel="stylesheet" id="'.$key.'" href="'.$value['relative_url'].'?ver='.$value['version'].'" type="text/css" media="all"/>';
            /** Pushing array */
            array_push($high_priority_array, $stylesheet);
            break;
        case 'low':
            /** Creating Priority 3 Array */
            if(!isset($low_priority_array)) $low_priority_array = array();
            /** JS function */
            $js_function = "if(media!='all')media='all'";
            /** Creating Stylesheet HTML link tag */
            $stylesheet = '<link rel="stylesheet" id="'.$key.'" href="'.$value['relative_url'].'?ver='.$value['version'].'" type="text/css" media="none" onload="'.$js_function.'"/>'."\r\n";
            /** Creating Stylesheet HTML link tag
             * inside noscript tag */
            $stylesheet .= '<noscript><link rel="stylesheet" id="'.$key.'" href="'.$value['relative_url'].'?ver='.$value['version'].'" type="text/css" media="all"/></noscript>';
            /** Pushing array */
            array_push($low_priority_array, $stylesheet);
            break;
        default:
            break;
    }

    if(isset($normal_priority_array))
    $result_array = array_merge($result_array, $normal_priority_array);

    if(isset($high_priority_array))
    $result_array = array_merge($result_array, $high_priority_array);

    if(isset($low_priority_array))
    $result_array = array_merge($result_array, $low_priority_array);

    if(!empty($result_array)) return $result_array;
    
    return FALSE;
}

function stag_get_enqueued_js_backend(){
    GLOBAL $STAG_MEM_CACHE;

    $all_data_sets = $STAG_MEM_CACHE->get_data_set('js-backend');

    $result_array = array();

    foreach($all_data_sets as $key => $data_set)
    foreach($data_set as $key => $value){
        if($value['async']){
            /** Creating Priority 2 Array */
            if(!isset($async_array)) $async_array = array();
            /** Creating Stylesheet HTML link tag */
            $stylesheet = '<script defer type="text/javascript" src="'.$value['relative_url'].'?ver='.$value['version'].'"></script>';
            /** Pushing array */
            array_push($async_array, $stylesheet);
        } else {
            /** Creating Synchronous Stylesheet 1 Array */
            if(!isset($normal_array)) $normal_array = array();
            /** Creating Stylesheet HTML link tag */
            $stylesheet = '<script type="text/javascript" src="'.$value['relative_url'].'?ver='.$value['version'].'"></script>';
            /** Pushing array */
            array_push($normal_array, $stylesheet);
        }
    }

    if(isset($normal_array))
    $result_array = array_merge($result_array, $normal_array);

    if(isset($async_array))
    $result_array = array_merge($result_array, $async_array);

    if(!empty($result_array)) return $result_array;
    
    return FALSE;
}

function stag_head_backend(){
    $enqueued_css_backend = stag_get_enqueued_css_backend();

    foreach($enqueued_css_backend as $key => $stylesheet){
        echo $stylesheet."\r\n";
    }
}

function stag_footer_backend(){
    $enqueued_js_backend = stag_get_enqueued_js_backend();

    foreach($enqueued_js_backend as $key => $js_script){
        echo $js_script."\r\n";
    }
}