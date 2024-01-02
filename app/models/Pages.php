<?php

namespace App\models;

use Libraries\Database\Database;

class Pages{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getTextAbout(){

        $sql = "SELECT `about_us`.`about_us` FROM `about_us`";
        $this->db->query($sql);
        $row = $this->db->fetch();

        if(!empty($row)){
            return $row;
        }else{
            return false;
        }

    }

    public function getCommentsByPostId($post_id){

        $sql = "SELECT `comment`.`body` , `users`.`first_name` FROM `comment` JOIN `users` ON `comment`.`user_id` = `users`.`id` WHERE `comment`.`verify_comment` = 1 AND `comment`.`post_id` = :post_id AND `comment`.`deleted_at` IS NULL;" ; 
        $this->db->query($sql);

        $this->db->bind(':post_id' , $post_id);

        $comments = $this->db->fetchAll();

        if($this->db->rowCount() > 0){
            return $comments;
        }else{
            return false;
        }
    }

    public function getSliders(){

        $sql = "SELECT `slider`.`images` , `slider`.`active` FROM `slider` WHERE `slider`.`status` = 1;";
        $this->db->query($sql);
        $sliders = $this->db->fetchAll();

        if($this->db->rowCount() > 0){
            return $sliders;
        }else{
            return false;
        }
    }

    public function addComments($data){

        $sql = "INSERT INTO `comment`(`comment`.`body` , `comment`.`user_id` , `comments`.`post_id`) VALUES (:body , :user_id , :post_id);";
        $this->db->query($sql);

        $this->db->bindArray([
            ':body' => $data['body'],
            ':user_id' => $data['user_id'],
            ':post_id' => $data['post_id']
        ]);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

}