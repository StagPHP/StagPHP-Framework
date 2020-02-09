<?php

/** StagPHP memory cache
 * 
 * It keeps the record of all the essential
 * data in form of key value pair in the memory 
 * during execution */
class stag_mem_cache{
    /** Memory cache variable */
    private $data = array();
  
    /** Add data */
    function add($data_set, $data_key, $data_value){
        if(empty($this->data) || !isset($this->data[$data_set]))
        $this->data[$data_set] = array();

        if(!empty($this->data[$data_set])){
            foreach($this->data[$data_set] as $data_sets){
                if(array_key_exists($data_key, $data_sets)){
                    $this->data[$data_set][$data_key] = $data_value;
            
                    return;
                }
            }
        }

        $array = array($data_key => $data_value);
    
        array_push($this->data[$data_set], $array);
    }
  
    /** Add all data */
    function get_all(){
        if(empty($this->data)) return NULL;

        return $this->data;
    }

    function get_data_set($data_set){
        if(empty($this->data)) return NULL;

        if(!isset($this->data[$data_set])) return NULL;

        return $this->data[$data_set];
    }

    function get_data($data_set, $data_key){
        if(empty($this->data)) return NULL;

        if(!isset($this->data[$data_set])) return NULL;

        if(!isset($this->data[$data_set][$data_key])) return NULL;

        return $this->data[$data_set][$data_key];
    }
}

GLOBAL $STAG_MEM_CACHE;
$STAG_MEM_CACHE = new stag_mem_cache;
