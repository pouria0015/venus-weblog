<?php

namespace App\controllers;

use Libraries\Controller\Controller;

    class Pages extends Controller{

        public $isAuthenticated;
        private $pagesModel;
        private $adminModel;
        public function __construct()
        {
            $this->pagesModel = $this->model('Pages');
            $this->adminModel = $this->model('Admin');
        }

        public function index(){
            $data['posts'] = $this->adminModel->getPosts();
            $data['sliders'] = $this->pagesModel->getSliders();

            $this->view('pages/index' , $data);
        }

        public function about(){
            $row = $this->pagesModel->getTextAbout();

            $this->view('pages/about' , $row);
        }

        public function single($id){
            $data['posts'] = $this->adminModel->getDataPostById($id);
            $data['comments'] = $this->pagesModel->getCommentsByPostId($id);


            $this->view('pages/single' , $data);
        
        }
    }