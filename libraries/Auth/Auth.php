<?php

/*
*   User Authentication
*/

namespace Libraries\Auth;

use Libraries\Session\Session;

class Auth {

    public function __construct()
    {
        
    }

    public static function loginUser($user){
        if(Session::set('user' , $user)){
            return true;
        }
        return false;
    }

    public static function logoutUser(){
        return Session::forget('user') === true ? true : false; 
    }

    public static function getLoggedInUser(){
        return Session::get('user');
    }

    public static function isAuthenticated(){
        return Session::has('user') ? true : false;
    }



}