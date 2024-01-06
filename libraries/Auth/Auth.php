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
        $status = false;
        if(Session::set('user' , $user)){
            $status = true;
            if(isset($user['cooke_token']) && !empty($user['cooke_token']) && !is_null($user['cooke_token'])){
                
                self::setUserCooke($user);
                
                $status = true;
                if($status === true){
                    return true;
                }
            }else{
                return true;
            }
        }
        return false;
    }

    private static function setUserCooke($data){
        $userDataString = implode(':' , 
                                        [
                                            'user_id' => $data['id'] ,
                                            'user_name' => $data['user_name'] ,
                                            'user_email' => $data['email'],
                                            'cooke_token' => $data['cooke_token']
                                        ]);
                                
        setcookie('Account' , $userDataString ,time() + 3600 * 24 ,"/" , "" , false , true);
        if(isset($_COOKIE['Account'])){
            return true;
        }else{
            return false;
        }
    }

    public static function removeUserCooke(){
        
        if(!empty($_COOKIE['Account']) && isset($_COOKIE['Account'])){
        if(setcookie('Account' , "" ,time() - 1 ,"/" , "" , false , true)){
            return true;
        }else{
            return false;
        }
        }
        return true;
    }

    public static function logoutUser(){
        return Session::forget('user') === true ? true : false; 
    }

    public static function getLoggedInUser(){
        return Session::get('user');
    }

    public static function getIdUser(){
        $userData  = Session::get('user');
        return $userData['id'];
    }

    public static function isAuthenticated(){
        return Session::has('user') ? true : false;
    }

    public static function isAuthenticatedAdmin(){
        if(!self::isAuthenticated()){
    
            redirect(""); 
    
        }elseif((self::getLoggedInUser()['user_type']) !== "admin" && (self::getLoggedInUser()['user_type']) !== "writer"){
                redirect("");
        }
    }


}