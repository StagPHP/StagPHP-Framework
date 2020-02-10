<?php
/**
 * Name:            StagPHP Template Functions
 * Description:     This file contains functions related to Template
 * 
 * @package:        StagPHP Core File
 */

function enqueue_css_backend($data_array){
    GLOBAL $STAG_MEM_CACHE;
    
    if(!isset($data_array['name']) || !isset($data_array['relative_url']) || !isset($data_array['version'])) return;

    if(isset($data_array['priority']) && 1 <= $data_array['priority'] && 9 >= $data_array['priority']){
        $priority = $data_array['priority'];
    } else $priority = '9';

    $resource_dir = get_assets_dir_uri(NULL, TRUE);

    $STAG_MEM_CACHE->add('stylesheet-backend-head', $data_array['name'], array(
        'relative_url'  => $resource_dir.$data_array['relative_url'],
        'version'       => 'v4.3.1',
        'priority'      => $priority
    ));
}

function stag_get_enqueued_css_backend(){
    GLOBAL $STAG_MEM_CACHE;

    $all_data_sets = $STAG_MEM_CACHE->get_data_set('stylesheet-backend-head');

    $result_array = array();

    foreach($all_data_sets as $key => $data_set)
    foreach($data_set as $key => $value)
    switch($value['priority']){
        case 1:
            /** Creating Priority 1 Array */
            if(!isset($array_p_1)) $array_p_1 = array();
            /** Creating Stylesheet HTML link tag */
            $stylesheet = '<link rel="stylesheet" id="'.$key.'" href="'.$value['relative_url'].'?ver='.$value['version'].'" type="text/css" media="all" priority="1"/>';
            /** Pushing array */
            array_push($array_p_1, $stylesheet);
            break;
        case 2:
            /** Creating Priority 2 Array */
            if(!isset($array_p_2)) $array_p_2 = array();
            /** Creating Stylesheet HTML link tag */
            $stylesheet = '<link rel="stylesheet" id="'.$key.'" href="'.$value['relative_url'].'?ver='.$value['version'].'" type="text/css" media="all" priority="2"/>';
            /** Pushing array */
            array_push($array_p_2, $stylesheet);
            break;
        case 3:
            /** Creating Priority 3 Array */
            if(!isset($array_p_3)) $array_p_3 = array();
            /** Creating Stylesheet HTML link tag */
            $stylesheet = '<link rel="stylesheet" id="'.$key.'" href="'.$value['relative_url'].'?ver='.$value['version'].'" type="text/css" media="all"  priority="3"/>';
            /** Pushing array */
            array_push($array_p_3, $stylesheet);
            break;
        case 4:
            /** Creating Priority 4 Array */
            if(!isset($array_p_4)) $array_p_4 = array();
            /** Creating Stylesheet HTML link tag */
            $stylesheet = '<link rel="stylesheet" id="'.$key.'" href="'.$value['relative_url'].'?ver='.$value['version'].'" type="text/css" media="all"  priority="4"/>';
            /** Pushing array */
            array_push($array_p_4, $stylesheet);
            break;
        case 5:
            /** Creating Priority 5 Array */
            if(!isset($array_p_5)) $array_p_5 = array();
            /** Creating Stylesheet HTML link tag */
            $stylesheet = '<link rel="stylesheet" id="'.$key.'" href="'.$value['relative_url'].'?ver='.$value['version'].'" type="text/css" media="all" priority="5"/>';
            /** Pushing array */
            array_push($array_p_5, $stylesheet);
            break;
        case 6:
            /** Creating Priority 6 Array */
            if(!isset($array_p_6)) $array_p_6 = array();
            /** Creating Stylesheet HTML link tag */
            $stylesheet = '<link rel="stylesheet" id="'.$key.'" href="'.$value['relative_url'].'?ver='.$value['version'].'" type="text/css" media="all" priority="6"/>';
            /** Pushing array */
            array_push($array_p_6, $stylesheet);
            break;
        case 7:
            /** Creating Priority 7 Array */
            if(!isset($array_p_7)) $array_p_7 = array();
            /** Creating Stylesheet HTML link tag */
            $stylesheet = '<link rel="stylesheet" id="'.$key.'" href="'.$value['relative_url'].'?ver='.$value['version'].'" type="text/css" media="all" priority="7"/>';
            /** Pushing array */
            array_push($array_p_7, $stylesheet);
            break;
        case 48:
            /** Creating Priority 8 Array */
            if(!isset($array_p_8)) $array_p_8 = array();
            /** Creating Stylesheet HTML link tag */
            $stylesheet = '<link rel="stylesheet" id="'.$key.'" href="'.$value['relative_url'].'?ver='.$value['version'].'" type="text/css" media="all" priority="8"/>';
            /** Pushing array */
            array_push($array_p_8, $stylesheet);
            break;
        case 9:
            /** Creating Priority 9 Array */
            if(!isset($array_p_9)) $array_p_9 = array();
            /** Creating Stylesheet HTML link tag */
            $stylesheet = '<link rel="stylesheet" id="'.$key.'" href="'.$value['relative_url'].'?ver='.$value['version'].'" type="text/css" media="all" priority="9"/>';
            /** Pushing array */
            array_push($array_p_9, $stylesheet);
            break;
        default:
            break;
    }

    if(isset($array_p_1)) $result_array = array_merge($result_array, $array_p_1);
    if(isset($array_p_2)) $result_array = array_merge($result_array, $array_p_2);
    if(isset($array_p_3)) $result_array = array_merge($result_array, $array_p_3);
    if(isset($array_p_4)) $result_array = array_merge($result_array, $array_p_4);
    if(isset($array_p_5)) $result_array = array_merge($result_array, $array_p_5);
    if(isset($array_p_6)) $result_array = array_merge($result_array, $array_p_6);
    if(isset($array_p_7)) $result_array = array_merge($result_array, $array_p_7);
    if(isset($array_p_8)) $result_array = array_merge($result_array, $array_p_8);
    if(isset($array_p_9)) $result_array = array_merge($result_array, $array_p_9);

    if(!empty($result_array)) return $result_array;
    
    return FALSE;
}

function stag_head_backend(){
    $enqueued_css_backend = stag_get_enqueued_css_backend();

    foreach($enqueued_css_backend as $key => $stylesheet){
        echo $stylesheet."\r\n";
    }
}