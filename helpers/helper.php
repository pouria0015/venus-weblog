<?php

function dd($arr , $exit = 0)
{
    if (isset($arr) && !empty($arr)) {
        echo ('<pre>');
        var_dump($arr);
        echo ('</pre>');
    }
    if($exit === 1){
        exit;
    }   
}


function add_class_error($errData , $key)
{
    
    if (isset($errData['errors'][$key]) && $errData['errors'][$key] === true) {

        return 'is-invalid';
    } else {
        return '';
    }
}

function add_class($class){
    if(isset($class) && !empty($class) && !is_null($class)){
        return $class;
    }else{
        return '';
    }
}

function view_error($errData , $key, $msg)
{
    if (isset($errData['errors'][$key]) && $errData['errors'][$key] === true) {
        return $msg;
    } else {
        return false;
    }
}

function generateToken(){
    return bin2hex(openssl_random_pseudo_bytes(32));
}
