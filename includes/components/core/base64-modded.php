<?php

function cyz_base64_encode($data){
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function cyz_base64_decode($data){
    return base64_decode(strtr($data, '-_', '+/').str_repeat('=', 3 - (3 + strlen($data)) % 4));
}
