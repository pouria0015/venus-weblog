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

        $sql = "SELECT `users`.`id` , `users`.`first_name` , `users`.`user_name` , `users`.`email` FROM users";
        $this->db->query($sql);
        $rows = $this->db->fetchAll();
        if($this->db->rowCount() > 0)
            return $rows;

    } 

    public function getComments(){
        
       $sql = "SELECT `comment`.`id`,`comment`.`body` , `posts`.`title` AS `post_title`, `users`.`user_name` , `comment`.`verify_comment` FROM comment JOIN users ON `comment`.`user_id` = `users`.`id` JOIN posts ON `comment`.`post_id` = `posts`.`id`;";
        $this->db->query($sql);
        $rows = $this->db->fetchAll();
        if($this->db->rowCount() > 0)
            return $rows;

    } 

    public function getPosts(){
        
        $sql = "SELECT `posts`.`id` , `posts`.`title` , `posts`.`body` , `posts`.`image` , `users`.`first_name` AS `writer` , `posts`.`published_at` FROM posts JOIN users ON `posts`.`user_id` = `users`.`id`;";
        $this->db->query($sql);
        $rows = $this->db->fetchAll();

        if($this->db->rowCount() > 0)
            return $rows;

    } 

    public function getDataPostById($id){
        $sql = "SELECT `posts`.`id` , `posts`.`title`, `posts`.`body` , `posts`.`image` , `users`.`first_name` AS `writer` , `posts`.`published_at` FROM posts  JOIN users ON `posts`.`user_id` = `users`.`id` WHERE `posts`.`id` = :id;      ";           
        $this->db->query($sql);

        $this->db->bind(':id' , $id);
        $row = $this->db->fetch();
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

}