<?php

namespace App\controllers;

use Libraries\Auth\Auth;
use Libraries\Controller\Controller;
use Libraries\Request\Request;
use Libraries\Validator\Validator;


    class Pages extends Controller{

        public $isAuthenticated;
        private $pagesModel;
        private $adminModel;
        private $userModel;
        private $req;
        private $validator;

        public function __construct()
        {
            $this->pagesModel = $this->model('Pages');
            $this->adminModel = $this->model('Admin');
            $this->userModel = $this->model('User');
            $this->req = new Request();
            $this->validator = new Validator($this->req);
        }

        public function index(){

            Auth::checkAuthenticationCookeAndLogin($this->userModel);


            $data['posts'] = $this->adminModel->getPosts();
            $data['sliders'] = $this->pagesModel->getSliders();

            $this->view('pages/index' , $data);
        }

        public function about(){

            Auth::checkAuthenticationCookeAndLogin($this->userModel);

            if (!Auth::isAuthenticated()) {
            
                if(Auth::isAuthenticatedCooke()){
                    $data = $this->userModel->getUserDataById(Auth::getDataCooke()[0]);
                    
                    Auth::loginUser(get_object_vars($data));
                    redirect('');
                }
    
            }

            $row = $this->pagesModel->getTextAbout();

            $this->view('pages/about' , $row);
        }

        public function single($id){

            Auth::checkAuthenticationCookeAndLogin($this->userModel);


            if (!Auth::isAuthenticated()) {
            
                if(Auth::isAuthenticatedCooke()){
                    $data = $this->userModel->getUserDataById(Auth::getDataCooke()[0]);
                    Auth::loginUser(get_object_vars($data));
                    redirect('');
                }
    
            }

            $data['posts'] = $this->adminModel->getDataPostById($id);
            $data['comments'] = $this->pagesModel->getCommentsByPostId($id);


            $this->view('pages/single' , $data);
        
        }

        public function addComment($postId){

            if (!Auth::isAuthenticated()) {
            
                if(Auth::isAuthenticatedCooke()){
                    $data = $this->userModel->getUserDataById(Auth::getDataCooke()[0]);
                    Auth::loginUser(get_object_vars($data));
                    redirect('pages/single');
                }
                flash('InsertComment' , ' برای ثبت نظر اول باید وارد شوید ' , 'alert alert-danger');
                redirect('pages/single');
    
            }

            if($this->req->isPostMethod()){

                $validate = $this->validator->Validate([
                    'body' => ['required' , 'minStr:3' , 'maxStr:240']
                ]);

                if(!$validate->hasError()){


                    $user_data = Auth::getLoggedInUser();
                    $data_comment = [
                        
                        'body' => $this->req->body,
                        'user_id' => $user_data['id'],
                        'post_id' => $postId
                    
                    ];
                
                    if($this->pagesModel->addComment($data_comment) === true){
                        redirect("pages/single/$postId");
                    }else{
                        flash('notAddComment' , 'مشکلی در افزودن نظر رخ داده است' , 'alert alert-danger');
                        redirect("pages/single/$postId");
                    }

                }else{

                    flash('ErrorAddComment' , ' تعداد کاراکتر های نظر باید بین 3 تا 245 باشد! '  , 'alert alert-danger');
                    redirect("pages/single/$postId");
                }

            }
    }


}