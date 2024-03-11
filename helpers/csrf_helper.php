<?php


function setCsrfToken(){
    if(!isset($_SESSION['csrf_token']) || is_null($_SESSION['csrf_token'])){

    $_SESSION['csrf_token'] = generateToken();

    }

}


function getCsrfToken(){

    if(isset($_SESSION['csrf_token']) && !is_null($_SESSION['csrf_token'])){
    
    return $_SESSION['csrf_token'];

    }else{
        return false;
    }
}

function deleteCsrfToken(){

    if(isset($_SESSION['csrf_token']) && !is_null($_SESSION['csrf_token'])){
    
    unset($_SESSION['csrf_token']);

    }
}