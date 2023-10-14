<?php

/*
*Session Manager class
*/

namespace Libraries\Session;

class Session{

    public static function get($name){
        if(isset($name)){
            return self::has($name) === true ? $_SESSION[$name] : null;
        }
        return null;
    }

    public static function set($name , $value = null){
        $_SESSION[$name] = $value;
        return true;
    }

    public static function has($name){
        if(isset($_SESSION[$name])){
            return true;
        }
        return false;
    }

    public static function forget($name){
        if(self::has($name)){
            unset($_SESSION[$name]);
            return true;
        }
        return false;
    } 

}