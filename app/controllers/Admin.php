<?php
namespace App\controllers;

use Libraries\Controller\Controller;
use Libraries\Auth\Auth;
use Libraries\Request\Request;
use Libraries\Validator\Validator;


class Admin extends Controller{

    private $adminModel;
    private $req;
    private $validator;


    public function __construct()
    {
        $this->adminModel = $this->model('Admin');    
        $this->req = new Request();
        $this->validator = new Validator($this->req);
    }

    public function index(){
        
        Auth::isAuthenticatedAdmin();

        $data['users'] = $this->adminModel->getUsers();
        
        $data['comments'] = $this->adminModel->getComments();

        $data['posts'] = $this->adminModel->getPosts();

        $this->view("admin/index" , $data);
    }

    public function addPost(){
        Auth::isAuthenticatedAdmin();

        $data['userData'] = Auth::getLoggedInUser();

        if($this->req->isPostMethod()){
            $validate = $this->validator->Validate([
                'title' => ['required' , 'minStr:3' , 'maxStr:50'],
                'text' => ['required' , 'minStr:200'],
                'category' => ['required' , 'minNumberLenth:1' , 'maxNumberLenth:1000'],
                'image:name' => ['required' , 'minStr:5' , 'maxStr:25'],
                'image:size' => ['fileMinSize:0.5', 'fileMaxSize:100']
            ]);

            if(!$validate->hasError()){

                $data_post = [
                    'title' => $this->req->title,
                    'body' => $this->req->text,
                    'category_id' => $this->req->category,
                    'user_id' => $data['userData']['id'],
                    'imagePost_name' => isset($this->req->image['name']) ? $this->req->image['name'] : '',
                    'imagePost_path' => isset($this->req->image['tmp_name']) ? $this->req->image['tmp_name'] : '' 
                ];

                move_uploaded_file($data_post['imagePost_path'] , APPROOT . '/public/img/posts/' . $data_post['imagePost_name']);
    
                if($this->adminModel->addPost($data_post) === true){
                    flash('addPost' , ' پست با موفقیت اضافه شد. ' , 'alert alert-success');
                }else{
                    flash('ErrorAddPost' , ' پست اضافه نشد(مشکلی پیش آمده)! ' , 'alert aler-danger');
                }
    
            }else{
                $data['errors'] = $validate->getErrors();
                $data['requests'] = $this->req->getAttribute(); 
            }

        }

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