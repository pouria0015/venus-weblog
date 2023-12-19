<?php

namespace App\models;

use Libraries\Database\Database;


class Admin{

    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getUsers(){

        $sql = "SELECT `users`.`id` , `users`.`first_name` , `users`.`user_name` , `users`.`email` , `users`.`is_active` FROM users WHERE `users`.`deleted_at` IS NULL;";
        $this->db->query($sql);
        $rows = $this->db->fetchAll();
        if($this->db->rowCount() > 0)
            return $rows;

    } 

    public function getComments(){
        
       $sql = "SELECT `comment`.`id`,`comment`.`body` , `posts`.`title` AS `post_title`, `users`.`user_name` , `comment`.`verify_comment` FROM comment JOIN users ON `comment`.`user_id` = `users`.`id` JOIN posts ON `comment`.`post_id` = `posts`.`id` WHERE `comment`.`deleted_at` IS NULL;";
        $this->db->query($sql);
        $rows = $this->db->fetchAll();
        if($this->db->rowCount() > 0)
            return $rows;

    } 

    public function getPosts(){
        
        $sql = "SELECT `posts`.`id` , `posts`.`title` , `posts`.`body` , `posts`.`image` , `users`.`first_name` AS `writer` , `posts`.`published_at` FROM posts JOIN users ON `posts`.`user_id` = `users`.`id` WHERE `posts`.`deleted_at` IS NULL;";
        $this->db->query($sql);
        $rows = $this->db->fetchAll();

        if($this->db->rowCount() > 0)
            return $rows;

    } 

    public function getDataPostById($id){
        $sql = "SELECT `posts`.`id` , `posts`.`title`, `posts`.`body` , `posts`.`image` , `users`.`first_name` AS `writer` , `posts`.`published_at` FROM posts  JOIN users ON `posts`.`user_id` = `users`.`id` WHERE `posts`.`id` = :id AND `posts`.`deleted_at` IS NULL;";           
        $this->db->query($sql);

        $this->db->bind(':id' , $id);
        $row = $this->db->fetch();
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    public function deleteUser($id){

        $sql = "UPDATE `users` SET `users`.`deleted_at` = NOW() , `users`.`is_active` = 0 WHERE `users`.`id` = :id;";
        $this->db->query($sql);
        $this->db->bind(':id' , $id);
        
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function activeUser($id){

        $sql = "UPDATE `users` SET `users`.`is_active` = 1 WHERE `users`.`id` = :id;";
        
        $this->db->query($sql);
        $this->db->bind(':id' , $id);
        
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function deleteComment($id){

        $sql =  "UPDATE `comment` SET `comment`.`deleted_at` = NOW() , `comment`.`verify_comment` = 0 WHERE `comment`.`id` = :id;";

        $this->db->query($sql);
        $this->db->bind(':id' , $id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function verifyComment($id){
        
        $sql = "UPDATE `comment` SET `comment`.`verify_comment` = 1 WHERE `comment`.`id` = :id;";

        $this->db->query($sql);
        $this->db->bind(':id' , $id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function addPost($data){
    
        $sql = "INSERT INTO `posts`(title , body , image , user_id , category_id) VALUES (:title , :body , :imageName , :user_id , :category_id);";
        $this->db->query($sql);

        $this->db->bindArray([
            ':title' => $data['title'],
            ':body' => $data['body'],
            ':image' => $data['imageName'],
            ':user_id' => $data['user_id'],
            ':category_id' => $data['category_id']
        ]);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    
    }   

    public function editPost($id){
        
    }

    public function deletePost($id){
        $sql = "UPDATE `posts` SET `posts`.`deleted_at` = NOW() WHERE `posts`.`id` = :id;";
        $this->db->query($sql);

        $this->db->bind(':id' , $id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

}