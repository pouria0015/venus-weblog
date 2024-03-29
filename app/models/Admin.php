<?php

namespace App\models;

use Libraries\Database\Database;


class Admin
{

    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getUsers()
    {

        $sql = "SELECT `users`.`id` , `users`.`first_name` , `users`.`user_name` , `users`.`email` , `users`.`is_active` , `users`.`deleted_at` FROM users ORDER BY `users`.`created_at` DESC;";
        $this->db->query($sql);
        $rows = $this->db->fetchAll();
        if ($this->db->rowCount() > 0)
            return $rows;
    }

    public function getComments()
    {

        $sql = "SELECT `comment`.`id`,`comment`.`body` , `posts`.`title` AS `post_title`, `users`.`user_name` , `comment`.`verify_comment` FROM comment JOIN users ON `comment`.`user_id` = `users`.`id` JOIN posts ON `comment`.`post_id` = `posts`.`id` WHERE `comment`.`deleted_at` IS NULL ORDER BY `comment`.`created_at` DESC;";
        $this->db->query($sql);
        $rows = $this->db->fetchAll();
        if ($this->db->rowCount() > 0)
            return $rows;
    }

    public function getPosts()
    {

        $sql = "SELECT `posts`.`id` , `posts`.`title` , `posts`.`body` , `posts`.`image` , `users`.`first_name` AS `writer` , `posts`.`published_at` FROM posts JOIN users ON `posts`.`user_id` = `users`.`id` WHERE `posts`.`deleted_at` IS NULL ORDER BY `posts`.`created_at` DESC;";
        $this->db->query($sql);
        $rows = $this->db->fetchAll();

        if ($this->db->rowCount() > 0)
            return $rows;
        else
            return false;
    }

    public function getNumberRows($table){
        $sql = "SELECT COUNT(`id`) As count FROM `{$table}` WHERE `deleted_at` IS NULL;";
        $this->db->query($sql);
        $row = $this->db->fetch();
    
        if ($this->db->rowCount() > 0){
            return $row;
        } else {
            return false;
        }
    }

    public function postPagination($limit , $total_rows){

        if (!isset ($_GET['page']) ) {
            $page_number = 1;  
        } else {  
            $page_number = $_GET['page'];  
        }  
        $total_rows = (int)$total_rows;
        $initial_page = ($page_number-1) * $limit; 
        $total_pages = ceil($total_rows / $limit);  
        
        $sql = "SELECT `posts`.`id` , `posts`.`title` , `posts`.`body` , `posts`.`image` , `users`.`first_name` AS `writer` , `posts`.`published_at` FROM posts JOIN users ON `posts`.`user_id` = `users`.`id` WHERE `posts`.`deleted_at` IS NULL ORDER BY `posts`.`created_at` DESC LIMIT {$initial_page} , {$limit};";
        $this->db->query($sql);
    
        $rows = $this->db->fetchAll();

        if($this->db->rowCount() > 0){
            return [$rows , $total_pages];
        }else{
            false;
        }
        
    }    

    public function getDataPostById($id)
    {
        $sql = "SELECT `posts`.`id` , `posts`.`title`, `posts`.`body` , `posts`.`image` , `posts`.`category_id` , `users`.`first_name` AS `writer` , `posts`.`published_at` , `categories`.`name` AS category_name  FROM posts  JOIN users ON `posts`.`user_id` = `users`.`id` JOIN `categories` ON `categories`.`id` = `posts`.`category_id` WHERE `posts`.`id` = :id AND `posts`.`deleted_at` IS NULL;";
        $this->db->query($sql);

        $this->db->bind(':id', $id);
        $row = $this->db->fetch();
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function deleteUser($id)
    {

        $sql = "UPDATE `users` SET `users`.`deleted_at` = NOW() , `users`.`is_active` = 0 WHERE `users`.`id` = :id;";
        $this->db->query($sql);
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function activeUser($id)
    {

        $sql = "UPDATE `users` SET `users`.`is_active` = 1 WHERE `users`.`id` = :id;";

        $this->db->query($sql);
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteComment($id)
    {

        $sql =  "UPDATE `comment` SET `comment`.`deleted_at` = NOW() , `comment`.`verify_comment` = 0 WHERE `comment`.`id` = :id;";

        $this->db->query($sql);
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function verifyComment($id)
    {

        $sql = "UPDATE `comment` SET `comment`.`verify_comment` = 1 WHERE `comment`.`id` = :id;";

        $this->db->query($sql);
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addPost($data)
    {

        $sql = "INSERT INTO `posts`(title , body , image , user_id , category_id) VALUES (:title , :body , :imageName , :user_id , :category_id);";
        $this->db->query($sql);

        $this->db->bindArray([
            ':title' => $data['title'],
            ':body' => $data['body'],
            ':imageName' => $data['imagePost_name'],
            ':user_id' => $data['user_id'],
            ':category_id' => $data['category_id']
        ]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function editPost($data)
    {
        $sql = 'UPDATE `posts` SET `posts`.`title` = :title , `posts`.`body` = :body , `posts`.`category_id` = :category_id , `posts`.`updated_at` = NOW() WHERE `posts`.`id` = :id;';

        $this->db->query($sql);

        $this->db->bindArray([
            ':id' => $data['id'],
            ':title' => $data['title'],
            ':body' => $data['body'],
            ':category_id' => $data['category_id']
        ]);

        if($this->db->execute()){

            return true;

        }else{

            return false;
        
        }
    }

    public function deletePost($id)
    {
        $sql = "UPDATE `posts` SET `posts`.`deleted_at` = NOW() WHERE `posts`.`id` = :id;";
        $this->db->query($sql);

        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addCategory($name)
    {

        $sql = "INSERT INTO `categories`(`categories`.`name`) VALUES (:name);";
        $this->db->query($sql);

        $this->db->bind(':name', $name);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function getCategory()
    {
        $sql = "SELECT `categories`.`id` , `categories`.`name` FROM `categories` WHERE `categories`.`deleted_at` IS NULL ORDER BY `categories`.`created_at` DESC;";

        $this->db->query($sql);

        $rows = $this->db->fetchAll();
        
        if ($this->db->rowCount() > 0) {
            return $rows; 
        } else {
            return false;
        }
    }

    public function addAds($data){
        $sql = "INSERT INTO ads(`ads`.`name` , `ads`.`text` , `ads`.`image`) VALUES(:name , :text , :image);";

        $this->db->query($sql);

        $this->db->bindArray([
            ':name' => $data['name'],
            ':text' => $data['text'],
            ':image' => $data['imageAds_name']
        ]);
        if ($this->db->execute()) {
            return true; 
        } else {
            return false;
        }
    }

    public function getAds(){

        $sql = "SELECT `ads`.`id` , `ads`.`name` , `ads`.`text` , `ads`.`image` , `ads`.`activeAds` , `ads`.`deleted_at` FROM `ads` WHERE `ads`.`deleted_at` IS NULL ORDER BY `ads`.`created_at` DESC;";
        $this->db->query($sql);

        $rows = $this->db->fetchAll();

        if($this->db->rowCount() > 0){
            return $rows;
        }else{
            return false;
        }

    }

    public function activeAds($id){

        $sql = "UPDATE `ads` SET `ads`.`activeAds` = 1 WHERE `ads`.`id` = :id;";
        $this->db->query($sql);
        $this->db->bind(':id' , $id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }


    public function inactiveAds($id){

        $sql = "UPDATE `ads` SET `ads`.`activeAds` = 0 WHERE `ads`.`id` = :id;";
        $this->db->query($sql);
        $this->db->bind(':id' , $id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function deleteAds($id){

        $sql = "UPDATE `ads` SET `ads`.`deleted_at` = NOW() WHERE `ads`.`id` = :id;";
        $this->db->query($sql);
        $this->db->bind(':id' , $id);

        if($this->db->execute()){
            return true;
        }else{
            return true;
        }

    }

    public function getSliders(){
   
        $sql = "SELECT `sliders`.`id` , `sliders`.`name` , `sliders`.`nameImage` , `sliders`.`activeSlider`   FROM `sliders` WHERE `sliders`.`deleted_at` IS NULL ORDER BY `sliders`.`id` DESC";
        $this->db->query($sql);
        $this->db->fetch();
        $sliders = $this->db->fetchAll();
        
        if($this->db->rowCount() > 0){
            return $sliders;
        }else{
            return false;
        }
   
   
    }

    public function addSlider($data){

        $sql = "INSERT INTO `sliders` (`sliders`.`name` , `sliders`.`nameImage`) VALUES(:name , :nameImage);";
        $this->db->query($sql);
        $this->db->bindArray([
            ':name' => $data['name'],
            ':nameImage' => $data['image_name'] 
        ]);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }
    public function activeSlider($id){

        $sql = "UPDATE `sliders` SET `sliders`.`activeSlider` = 1 WHERE `sliders`.`id` = :id;";
        $this->db->query($sql);
        $this->db->bind(':id' , $id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function inactiveSlider($id){
        $sql = "UPDATE `sliders` SET `sliders`.`activeSlider` = 0 WHERE `sliders`.`id` = :id;";
        $this->db->query($sql);
        $this->db->bind(':id' , $id);
        

        if($this->db->execute()){
            return true;
        }else{
            return false;

        }
    
    }

    public function deleteSlider($id){
        $sql = "UPDATE `sliders` SET `sliders`.`deleted_at` = NOW() , `sliders`.`activeSlider` = 0  WHERE `sliders`.`id` = :id;";
        $this->db->query($sql);
        $this->db->bind(':id' , $id);


        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

}
