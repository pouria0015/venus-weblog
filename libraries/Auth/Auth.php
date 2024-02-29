<?php

/*
*   User Authentication
*/

namespace Libraries\Auth;

use Libraries\Session\Session;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class Auth {

    public function __construct()
    {
        
    }

    public static function loginUser($user){
        $status = false;
        if(Session::set('user' , $user)){
            $status = true;

            if(isset($user['cookie_token']) && !is_null($user['cookie_token']) && $user['cookie_token'] != "" && $user['cookie_token'] != 0){
   
                $res = self::setJwt($user);
                if(!is_null($res)){
                    self::setUserCooke($res);
                if($status === true){

                    return true;
                
                }
            }
            }else{

                return true;

            }
        }
        return false;
    }

    private static function setUserCooke($data){
        // $userDataString = implode(':' , 
        //                                 [
        //                                     'user_id' => $data['id'] ,
        //                                     'user_name' => $data['user_name'] ,
        //                                     'user_email' => $data['email'],
        //                                     'cookie_token' => $data['cookie_token']
        //                                 ]);
                                
        setcookie('Account' , $data ,time() + 3600 * 24 ,"/" , "" , false , true);
        if(isset($_COOKIE['Account'])){
            return true;
        }else{
            return false;
        }
    }

    public static function getDataCooke(){
        return self::getDataJwt();
    }

    public static function getDataJwt(){
        
        $token = JWT::decode($_COOKIE['Account'] , new Key(SECRET_KEY, 'HS256'));


        if (
            $token->iss !== URLROOT ||
            $token->iat > time() ||
            $token->exp < time()
        ) {
            return false;

        }else{

            return explode(':' , $token->data);

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
        return (Session::forget('user') && self::removeUserCooke()) === true ? true : false; 
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

    public static function isAuthenticatedCooke(){
        if(!empty($_COOKIE['Account']) && isset($_COOKIE['Account'])){
            return true; 
        } else{
            return false;
        }
    }

    public static function isAuthenticatedAdmin(){
        if(!self::isAuthenticated()){
    
            redirect(""); 
    
        }elseif((self::getLoggedInUser()['user_type']) !== "admin" && (self::getLoggedInUser()['user_type']) !== "writer"){
                redirect("");
        }
    }


    public static function setJwt($data){

        $secretKey = SECRET_KEY;
        $userDataString = implode(':' , 
        [
            'user_id' => $data['id'] ,
            'user_name' => $data['user_name'] ,
            'user_email' => $data['email'],
            'cookie_token' => $data['cookie_token']
        ]);
        $token = [
            'iss' => URLROOT,
            'aud' => URLROOT,
            "iat" => time(),
            "exp" => time() + (3600 * 24),
            "data" => $userDataString
        ];


        $jwt = JWT::encode($token , $secretKey , "HS256");
        return $jwt;

    }

}