<?php
namespace App\controllers;

use Libraries\Controller\Controller;
use Libraries\Auth\Auth;
use Libraries\Request\Request;
use Libraries\Validator\Validator;


class Admin extends Controller{

    private $adminModel;
    private $userModel;

    private $req;
    private $validator;


    public function __construct()
    {
        $this->adminModel = $this->model('Admin');
        $this->userModel = $this->model('User');

        $this->req = new Request();
        $this->validator = new Validator($this->req);
    }

    public function index(){
        if (!Auth::isAuthenticated()) {
            
            if(Auth::isAuthenticatedCooke()){
                $data = $this->userModel->getUserDataById(Auth::getDataCooke()[0]);
                Auth::loginUser(get_object_vars($data));
                redirect('');
            }

        }
        Auth::isAuthenticatedAdmin();

        $data['users'] = $this->adminModel->getUsers();
        
        $data['comments'] = $this->adminModel->getComments();

        $data['posts'] = $this->adminModel->getPosts();
        $data['ads'] = $this->adminModel->getAds();
        $data['sliders'] = $this->adminModel->getSliders();

        $this->view("admin/index" , $data);
    }

    public function addPost(){

        if (!Auth::isAuthenticated()) {
            
            if(Auth::isAuthenticatedCooke()){
                $data = $this->userModel->getUserDataById(Auth::getDataCooke()[0]);
                Auth::loginUser(get_object_vars($data));
                redirect('');
            }

        }

        Auth::isAuthenticatedAdmin();
        $data['errors'] = [];
        $data['requests'] = [];
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
                    redirect("admin/index");
                }else{
                    flash('ErrorAddPost' , ' پست اضافه نشد(مشکلی پیش آمده)! ' , 'alert aler-danger');
                }
    
            }else{
                $data['errors'] = $validate->getErrors();
                $data['requests'] = $this->req->getAttribute(); 
            }

        }
        $data['category'] = $this->adminModel->getCategory();
        $this->view("admin/addPost" , $data);
    }

    public function editPosts($id){

        if (!Auth::isAuthenticated()) {
            
            if(Auth::isAuthenticatedCooke()){
                $data = $this->userModel->getUserDataById(Auth::getDataCooke()[0]);
                Auth::loginUser(get_object_vars($data));
                redirect('');
            }

        }
        Auth::isAuthenticatedAdmin();
    
        $data['errors'] = [];
        $data['requests'] = [];

        if($this->req->isPostMethod()){
          
            
            $validate = $this->validator->Validate([
                'title' => ['required' , 'minStr:3' , 'maxStr:50'],
                'body' => ['required' , 'minStr:200'],
                'category' => ['required' , 'minNumberLenth:1' , 'maxNumberLenth:1000'],
            ]);

            if(!$validate->hasError()){

                $data = [
                    'id' => $id,
                    'title' => $this->req->title,
                    'body' => $this->req->body,
                    'category_id' => $this->req->category
                ];

                if($this->adminModel->editPost($data)){
                   
                    flash('accessEditPost' , ' پست با موفقیت ویرایش شد ');
                    redirect('admin/index');
                }else{
                 
                    flash('NotAccessEditPost' , ' ویرایش پست با مشکل مواجه شد ' , 'alert alert-danger');
                    redirect('admin/index');
                }

            }else{
                $data['errors'] = $validate->getErrors();
            }
        }

        $data['postData'] = $this->adminModel->getDataPostById($id);
        $data['category'] = $this->adminModel->getCategory();

    

        $this->view("admin/editPosts" , $data);
    }

    public function deletePost($id){

        if (!Auth::isAuthenticated()) {
            
            if(Auth::isAuthenticatedCooke()){
                $data = $this->userModel->getUserDataById(Auth::getDataCooke()[0]);
                Auth::loginUser(get_object_vars($data));
                redirect('');
            }

        }
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

        if (!Auth::isAuthenticated()) {
            
            if(Auth::isAuthenticatedCooke()){
                $data = $this->userModel->getUserDataById(Auth::getDataCooke()[0]);
                Auth::loginUser(get_object_vars($data));
                redirect('');
            }

        }
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

        if (!Auth::isAuthenticated()) {
            
            if(Auth::isAuthenticatedCooke()){
                $data = $this->userModel->getUserDataById(Auth::getDataCooke()[0]);
                Auth::loginUser(get_object_vars($data));
                redirect('');
            }

        }
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

        if (!Auth::isAuthenticated()) {
            
            if(Auth::isAuthenticatedCooke()){
                $data = $this->userModel->getUserDataById(Auth::getDataCooke()[0]);
                Auth::loginUser(get_object_vars($data));
                redirect('');
            }

        }
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

        if (!Auth::isAuthenticated()) {
            
            if(Auth::isAuthenticatedCooke()){
                $data = $this->userModel->getUserDataById(Auth::getDataCooke()[0]);
                Auth::loginUser(get_object_vars($data));
                redirect('');
            }

        }
        Auth::isAuthenticatedAdmin();
        

        if($this->adminModel->verifyComment($id)){
            flash('verifyComment' , ' نظر مورد نظر تایید شد ');
            redirect('admin/index');
        }else{
            flash('verifyComment' , ' نظر مورد نظر تایید نشد(خطایی رخ داده است) ' , 'alert alert-danger');
            redirect('admin/index');
        }

    }


    public function addCategory(){

        if (!Auth::isAuthenticated()) {
            
            if(Auth::isAuthenticatedCooke()){
                $data = $this->userModel->getUserDataById(Auth::getDataCooke()[0]);
                Auth::loginUser(get_object_vars($data));
                redirect('');
            }

        }
        Auth::isAuthenticatedAdmin();
        
        $data['errors'] = [];
        $data['requests'] = [];

        if($this->req->isPostMethod()){
            
            $validate = $this->validator->Validate([
                'category' => ['required' , 'minStr:3' , 'maxStr:50']
            ]);

            if(!$validate->hasError()){

                $data = [
                    'categoryName' => $this->req->category
                ];

                if($this->adminModel->addCategory($data['categoryName'])){

                    flash('accessAddCategory' , ' دسته بندی مورد نظر با موفقیت اضافه شد ');
                    redirect('admin/index');

                }else{

                    flash('NotaccessAddCategory' , ' خطایی رخ داده است و دست بندی اضافه نشد ');
                    redirect('admin/addcategory');

                }

            }else{

                $data['errors'] = $validate->getErrors();

            }

        }

        $this->view('admin/addCategory' , (isset($data)) ? $data : []);

    }

    public function addAds(){

        if (!Auth::isAuthenticated()) {
            
            if(Auth::isAuthenticatedCooke()){
                $data = $this->userModel->getUserDataById(Auth::getDataCooke()[0]);
                Auth::loginUser(get_object_vars($data));
                redirect('');
            }

        }
        Auth::isAuthenticatedAdmin();
        $data['errors'] = [];
        $data['requests'] = [];
        
        dd($this->req->getAttribute);
        if($this->req->isPostMethod()){
            $validate = $this->validator->Validate([
                'name' => ['required' , 'minStr:3' , 'maxStr:50'],
                'text' => ['required' , 'minStr:10' , 'maxStr:100'],
                'image:name' => ['required' , 'minStr:5' , 'maxStr:25'],
                'image:size' => ['fileMinSize:0.5', 'fileMaxSize:1024']
            ]);
            

            if(!$validate->hasError()){

                $data_Ads = [
                    'name' => $this->req->name,
                    'text' => $this->req->text,
                    'imageAds_name' => isset($this->req->image['name']) ? $this->req->image['name'] : '',
                    'imageAds_path' => isset($this->req->image['tmp_name']) ? $this->req->image['tmp_name'] : '' 
                ];
                
                move_uploaded_file($data_Ads['imageAds_path'] , APPROOT . '/public/img/Ads/' . $data_Ads['imageAds_name']);
    
                if($this->adminModel->addAds($data_Ads) === true){
                    flash('addAds' , ' تبلیغ با موفقیت اضافه شد. ' , 'alert alert-success');
                    redirect("admin/index");
                }else{
                    flash('ErrorAddAds' , ' تبلیغ اضافه نشد(مشکلی پیش آمده)! ' , 'alert aler-danger');
                }
    
            }else{
                $data['errors'] = $validate->getErrors();
                $data['requests'] = $this->req->getAttribute(); 
            }

        }

        $this->view('admin/addAds' , (isset($data)) ? $data : []);

    }


    public function activeAds($id){

        if (!Auth::isAuthenticated()) {
            
            if(Auth::isAuthenticatedCooke()){
                $data = $this->userModel->getUserDataById(Auth::getDataCooke()[0]);
                Auth::loginUser(get_object_vars($data));
                redirect('');
            }

        }
        Auth::isAuthenticatedAdmin();

        if($this->adminModel->activeAds($id)){
            flash('activeAds' , " تبلیغ با موفقیت فعال شد ");
            redirect("admin/index");
        }else{
            flash('NotActiveAds' , " مشکلی پیش امده است و تبلیغ فعال نشد " , 'alert alert-danger');
            redirect("admin/index");
        }

    }


    public function inactiveAds($id){

        if (!Auth::isAuthenticated()) {
            
            if(Auth::isAuthenticatedCooke()){
                $data = $this->userModel->getUserDataById(Auth::getDataCooke()[0]);
                Auth::loginUser(get_object_vars($data));
                redirect('');
            }

        }
        Auth::isAuthenticatedAdmin();

        if($this->adminModel->inactiveAds($id)){
            flash('inactiveAds' , " تبلیغ با موفقیت غیرفعال شد ");
            redirect("admin/index");
        }else{
            flash('NotInActiveAds' , " مشکلی پیش امده است و تبلیغ غیرفعال نشد " , 'alert alert-danger');
            redirect("admin/index");
        }

    }

    public function deleteAds($id){

        if (!Auth::isAuthenticated()) {
            
            if(Auth::isAuthenticatedCooke()){
                $data = $this->userModel->getUserDataById(Auth::getDataCooke()[0]);
                Auth::loginUser(get_object_vars($data));
                redirect('');
            }

        }
        Auth::isAuthenticatedAdmin();

        if($this->adminModel->deleteAds($id)){
            flash('DeleteAds' , " تبلیغ با موفقیت حذف شد ");
            redirect("admin/index");
        }else{
            flash('NotDeleteAds' , " مشکلی پیش امده است و تبلیغ حذف نشد " , 'alert alert-danger');
            redirect("admin/index");
        }

    }

    public function addSlider(){

    $this->view('admin/addSlider');

    }

    public function activeSlider($id){

        if (!Auth::isAuthenticated()) {
            
            if(Auth::isAuthenticatedCooke()){
                $data = $this->userModel->getUserDataById(Auth::getDataCooke()[0]);
                Auth::loginUser(get_object_vars($data));
                redirect('');
            }

        }
        Auth::isAuthenticatedAdmin();

        if($this->adminModel->activeSlider($id)){
            flash("ActiveSlider" , " اسلایدر با موفقیت فعال شد ");
            redirect("admin/index");
        }else{
            flash("NotActiveSlider" , " اسلایدر فعال نشد " , "alert danger-alert");
            redirect("admin/index");
        }


    }

    public function inactiveSlider($id){
        

        if (!Auth::isAuthenticated()) {
            
            if(Auth::isAuthenticatedCooke()){
                $data = $this->userModel->getUserDataById(Auth::getDataCooke()[0]);
                Auth::loginUser(get_object_vars($data));
                redirect('');
            }

        }
        Auth::isAuthenticatedAdmin();

        if($this->adminModel->inactiveSlider($id)){
            flash("InactiveSlider" , " اسلایدر با موفقیت غیر فعال شد ");
            redirect("admin/index");
        }else{
            flash("NotInactiveSlider" , " اسلایدر غیرفعال نشد " , "alert danger-alert");
            redirect("admin/index");
        }

    }   

    public function deleteSlider($id){
    

        if (!Auth::isAuthenticated()) {
            
            if(Auth::isAuthenticatedCooke()){
                $data = $this->userModel->getUserDataById(Auth::getDataCooke()[0]);
                Auth::loginUser(get_object_vars($data));
                redirect('');
            }

        }
        Auth::isAuthenticatedAdmin();

        if($this->adminModel->deleteSlider($id)){
            flash("DeleteSlider" , " اسلایدر با موفقیت حذف شد ");
            redirect("admin/index");
        }else{
            flash("NotDeleteSlider" , " اسلایدر حذف نشد " , "alert danger-alert");
            redirect("admin/index");
        }

    }



} 