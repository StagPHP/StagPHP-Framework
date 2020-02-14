<?php

function error_response($data = FALSE){
    if(FALSE === $data) $data = array(
        'description' => 'Access denied!'
    );

    echo json_encode(array(
        'status'        => FALSE,
        'description'   => $data['description'],
        'result'        => NULL
    ));
    
    exit;
}

function success_response($data){
    echo json_encode(array(
        'status'        => TRUE,
        'description'   => $data['description'],
        'result'        => $data['result']
    ));
    
    exit;
}