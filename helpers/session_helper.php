<?php

    function get($name){
        if(isset($name)){
            return has($name) === true ? $_SESSION[$name] : null;
        }
        return null;
    }

    function set($name , $value = null){
        $_SESSION[$name] = $value;
    }

    function has($name){
        if(isset($_SESSION[$name])){
            return true;
        }
        return false;
    }

    function forget($name){
        if(has($name)){
            unset($_SESSION[$name]);
            return true;
        }
        return false;
    } 