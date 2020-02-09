<?php

class stag_session_cache{
    static function add($data_set, $data_key, $data_value){
        if(!isset($_SESSION['stag_installation_memory'])) $stag_installation_memory = array();
        else $stag_installation_memory = $_SESSION['stag_installation_memory'];
    
        if(empty($stag_installation_memory) || !isset($stag_installation_memory[$data_set]))
        $stag_installation_memory[$data_set] = array();
    
        if(!empty($stag_installation_memory[$data_set])){
          foreach($stag_installation_memory[$data_set] as $data_sets){
            if(array_key_exists($data_key, $data_sets)){
              $stag_installation_memory[$data_set][$data_key] = $data_value;
      
              return;
            }
          }
        }
    
        $array = array($data_key => $data_value);
    
        array_push($stag_installation_memory[$data_set], $array);
    
        $_SESSION['stag_installation_memory'] = $stag_installation_memory;
    }

    static function get_all_data(){
        if(!isset($_SESSION['stag_installation_memory']) || empty($_SESSION['stag_installation_memory'])) return FALSE;

        return $_SESSION['stag_installation_memory'];
    }

    static function get_data_set($data_set){
        if(!isset($_SESSION['stag_installation_memory']) || empty($_SESSION['stag_installation_memory'])) return FALSE;

        $stag_installation_memory = $_SESSION['stag_installation_memory'];

        if(!isset($stag_installation_memory[$data_set])) return FALSE;

        return $stag_installation_memory[$data_set];
    }

    static function get_data($data_set, $data_key){
        if(!isset($_SESSION['stag_installation_memory']) || empty($_SESSION['stag_installation_memory'])) return FALSE;

        $stag_installation_memory = $_SESSION['stag_installation_memory'];

        if(!isset($stag_installation_memory[$data_set])) return FALSE;

        if(!isset($stag_installation_memory[$data_set][$data_key])) return FALSE;

        return $stag_installation_memory[$data_set][$data_key];
    }

    static function reset(){
        if(!isset($_SESSION['stag_installation_memory'])) return FALSE;

        $_SESSION['stag_installation_memory'] = NULL;
    }
}