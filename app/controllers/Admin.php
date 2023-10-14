<?php
namespace App\controllers;

use Libraries\Controller\Controller;
use Libraries\Auth\Auth;


class Admin extends Controller{

    private $adminModel;


    public function __construct()
    {
        $this->adminModel = $this->model('Admin');    
    }

    public function index(){
        
        if(!Auth::isAuthenticated()){
    
            redirect(""); 
    
        }elseif((Auth::getLoggedInUser()['user_type']) !== "admin" && (Auth::getLoggedInUser()['user_type']) !== "writer"){
                redirect("");
        }

        $data['users'] = $this->adminModel->getUsers();
        
        $data['comments'] = $this->adminModel->getComments();

        $data['posts'] = $this->adminModel->getPosts();

        $this->view("admin/index" , $data);
    }

    public function addPosts(){
        $this->view("admin/addPosts");
    }

    public function editPosts($id){
        $this->view("admin/editPosts");
    }

} 