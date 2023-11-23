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
        
        Auth::isAuthenticatedAdmin();

        $data['users'] = $this->adminModel->getUsers();
        
        $data['comments'] = $this->adminModel->getComments();

        $data['posts'] = $this->adminModel->getPosts();

        $this->view("admin/index" , $data);
    }

    public function addPosts(){
        Auth::isAuthenticatedAdmin();

        $this->view("admin/addPost");
    }

    public function editPosts($id){
        Auth::isAuthenticatedAdmin();

        $this->view("admin/editPosts");
    }

    public function deletePost($id){
        Auth::isAuthenticatedAdmin();
        if($this->adminModel->deletePost($id)){
            flash('deletePost' , ' پست مورد نظر حذف شد. ');
            redirect('admin/index');
        }else{
            flash('deletePost' , 'پست حذف نشد.');
            redirect('admin/index');
        }
        
    }

    public function activeUser($id){
        Auth::isAuthenticatedAdmin();

        if($this->adminModel->activeUser($id)){
            flash('activeUser' , ' حساب کاربری فعال شد ');
            redirect('admin/index');
        }else{
            flash('activeUser' , ' حساب کاربری فعال نشد(خطایی رخ داده است) ' , 'alert alert-danger');
            redirect('admin/index');
        }
        
    }

    public function deleteUser($id){
        Auth::isAuthenticatedAdmin();

        if($this->adminModel->deleteUser($id)){
            flash('deleteUser' , ' حساب کاربر با موفقیت حذف شد ');
            redirect('admin/index');
        }else{
            flash('deleteUser' , ' حساب کاربری حذف نشد(خطایی رخ داده است) ' , 'alert alert-danger');
            redirect('admin/index');
        }

    }

    public function deleteComment($id){
        Auth::isAuthenticatedAdmin();

        if($this->adminModel->deleteComment($id)){
            flash('deleteComment' , ' نظر مورد نظر حذف شد ');
            redirect('admin/index');
        }else{
            flash('deleteComment' , ' نظر مورد نظر حذف نشد(خطایی رخ داده است) ' , 'alert alert-danger');
            redirect('admin/index');
        }
    }

    public function verifyComment($id){
        Auth::isAuthenticatedAdmin();
        
        if($this->adminModel->verifyComment($id)){
            flash('verifyComment' , ' نظر مورد نظر تایید شد ');
            redirect('admin/index');
        }else{
            flash('verifyComment' , ' نظر مورد نظر تایید نشد(خطایی رخ داده است) ' , 'alert alert-danger');
            redirect('admin/index');
        }

    }


 

} 