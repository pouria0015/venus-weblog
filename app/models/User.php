<?php

namespace App\models;

use Libraries\Database\Database;

class User
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function findUserByEmail($email)
    {

        $sql = "SELECT `users`.`email` FROM `users` WHERE `users`.`email` = :email";
        $this->db->query($sql);

        //bind Param :email
        $this->db->bind(':email', $email);

        //execute query and fetch resulte
        $this->db->fetch();

        //check row resulte
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function login($data)
    {
        // , `users`.`user_name` , `users`.`password` ,`users`.`first_name` , `users`.`email` , `users`.`profile`, `users`.`is_active`,`users`.`user_type` , `users`.`cooke_token` , `users`.`created_at`
        $sql = "SELECT `users`.`id` , `users`.`password`  FROM `users` WHERE `users`.`email` = :email;";
        $this->db->query($sql);

        $this->db->bind(':email', $data['email']);

        $row = $this->db->fetch();
        $password_hash = $row->password;

        if ($this->db->rowCount() > 0) {
            if(password_verify($data['password'] , $password_hash)){
                return $row;                
            }else{
                return false;
            }
        }
        return false;
    }


    public function update($data)
    {
        $sql = "UPDATE `users` SET `users`.`email` = :email , `users`.`first_name` = :first_name ,`users`.`user_name` = :user_name WHERE `users`.`id` = :id;";
        
        $this->db->query($sql);

        $dataBind = [
            ':id' => $data['id'],
            ':email' => $data['email'],
            ':first_name' => $data['first_name'],
            ':user_name' => $data['user_name']
        ];

        $this->db->bindArray($dataBind);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserDataById($id){
        $sql = "SELECT `users`.`id` , `users`.`user_name` ,`users`.`first_name` , `users`.`email` , `users`.`profile`, `users`.`is_active`,`users`.`user_type` , `users`.`cookie_token` , `users`.`created_at` FROM `users` WHERE `users`.`id` = :id;";
        $this->db->query($sql);

        $this->db->bind(':id' , $id);

        $row = $this->db->fetch();
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }


    public function getUserDataByEmail($email){
        $sql = "SELECT `users`.`id` , `users`.`user_name` ,`users`.`first_name` , `users`.`email` , `users`.`profile`, `users`.`is_active`,`users`.`user_type` , `users`.`cookie_token` , `users`.`verify_token` , `users`.`verify_token_expire` , `users`.`created_at` , `users`.`csrf_token` FROM `users` WHERE `users`.`email` = :email;";
        $this->db->query($sql);

        $this->db->bind(':email' , $email);

        $row = $this->db->fetch();
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    public function checkVerifyToken($token , $email){
        
        if($userData = $this->getUserDataByEmail($email)){
            
            if($userData->verify_token === $token && $userData->verify_token_expire > time()){
                
                $sql = "UPDATE `users` SET `users`.`is_active` = 1 WHERE `users`.`id` = :id;";

                $this->db->query($sql);
                $this->db->bind(':id', $userData->id);
        
                if ($this->db->execute()) {
                    return true;
                } else {
                    return false;
                }

            }else{
                return false;
            }

        }else{
            return false;
        }

    }

    public function insertUser($data_user){
        date_default_timezone_set('Asia/Tehran');
        if($this->findUserByEmail($data_user['email'])){
            return "exists";
        }
        $data_user['password'] = password_hash($data_user['password'] , PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (`email`, `first_name`, `user_name`, `profile`, `password` , `verify_token` , `verify_token_expire`)VALUES (:email, :first_name, :user_name, :profile, :password , :verify_token , :verify_token_expire)";
        $this->db->query($sql);

        $bind = [
            ':user_name' => $data_user['user_name'],
            ':password' => $data_user['password'],
            ':first_name' => $data_user['first_name'],
            ':email' => $data_user['email'] ,
            ':profile' => $data_user['profile'],
            ':verify_token' => generateToken(),
            ':verify_token_expire' => time() + 3600
        ];

        $this->db->bindArray($bind);

        if($this->db->execute()){
            return ['status' => true , 'verify_token' => $bind[':verify_token']];
        }else{
            return false;
        }

    }


    public function creatCookeToken($id){
        $sql = "UPDATE `users` SET `users`.`cookie_token` = :token WHERE `users`.`id` = :id;";

        $this->db->query($sql);

        $this->db->bindArray([
            'id' => $id,
            'token' => generateToken()
        ]);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function deleteCookeToken($id){

        $sql = "UPDATE `users` SET `users`.`cookie_token` = NULL WHERE `users`.`id` = :id;";

        $this->db->query($sql);

        $this->db->bind('id' , $id);

        if($this->db->execute()){
            return true;
        }else{  
            return false;
        }

    }
}
