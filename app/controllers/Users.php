<?php

namespace App\controllers;

use Libraries\Controller\Controller;
use Libraries\Request\Request;
use Libraries\Validator\Validator;
use Libraries\Auth\Auth;


class Users extends Controller
{

    private $req;
    private $validator;
    private $userModel;

    public function __construct()
    {
        $this->req = new Request();
        $this->validator = new Validator($this->req);
        $this->userModel = $this->model('User');
    }

    public function index()
    {
    }

    public function userPanel()
    {
        if (!Auth::isAuthenticated()) {
            redirect("");
        }

        $data['userData'] = Auth::getLoggedInUser();

        if ($this->req->isPostMethod()) {
            $validate = $this->validator->Validate([
                'email' => ['required', 'minStr:5', 'maxStr:50', 'email'],
                'user_name' => ['required', 'minStr:4', 'maxStr:50'],
                'first_name' => ['required', 'minStr:3', 'maxStr:15'],
            ]);

            if (!$validate->hasError()) {
                $dataArray = [
                    'id' => $data['userData']['id'],
                    'email' => $this->req->email,
                    'user_name' => $this->req->user_name,
                    'first_name' => $this->req->first_name
                ];


                if ($this->userModel->update($dataArray)) {

                    Auth::logoutUser();
                    $user = get_object_vars($this->userModel->getUserDataById($data['userData']['id']));
                    Auth::loginUser($user);

                    flash('update_data', "عملیات با موفقیت انجام شد");
                } else {
                    flash('update_data', "خطایی رخ داده", "alert alert-danger");
                }
            } else {
                $data['errors'] = $validate->getErrors();
            }
        }

        $this->view("users/userPanel", $data);
    }

    public function login()
    {

        if ($this->req->isPostMethod()) {
            $validate = $this->validator->Validate([
                'email' => ['required', 'minStr:5', 'maxStr:50', 'email'],
                'password' => ['required', 'minStr:6', 'maxStr:25'],
            ]);
            if (!$validate->hasError()) {
                if ($this->userModel->findUserByEmail($this->req->email)) {
                    $loggedInUser = $this->userModel->login(['email' => $this->req->email, 'password' => $this->req->password]);

                    if ($loggedInUser) {

                        if ($loggedInUser->is_active === "1") {

                            if (Auth::loginUser(get_object_vars($loggedInUser))) {
                                redirect("");
                            } else {
                                flash('ErrorLoggedInUser', "خطایی رخ داده است(ورود نا موفق)", "alert alert-danger");
                            }

                        }else{

                            flash('ErrorLoggedInUser', " حساب کاربری شما تایید نشده است ", "alert alert-danger");

                        }
                    } else {
                        flash('ErrorLoggedInUser', "پسورد نادرست است", "alert alert-danger");
                    }
                } else {
                    flash('ErrorLoggedInUser', "همچین کاربری وجود ندارد", "alert alert-danger");
                }
            } else {
                $data['errors'] = $validate->getErrors();
                $data['requests']['email'] = $this->req->email;
            }
        }

        if (isset($data))
            $this->view("users/login", $data);
        else
            $this->view("users/login");
    }

    public function register()
    {
        
        if ($this->req->isPostMethod()) {

            $validate = $this->validator->Validate([
                'first_name' => ['required', 'minStr:3', 'maxStr:25'],
                'user_name' => ['required', 'minStr:3', 'maxStr:25'],
                'password' => ['required', 'minStr:8', 'maxStr:30', 'confirm'],
                'email' => ['required', 'minStr:5', 'maxStr:50'],
                'profile:name' => ['minStr:5', 'maxStr:50', 'FileSuffix:png'],
                'profile:size' => ['fileMinSize:0.5', 'fileMaxSize:8']
            ]);

            if ($validate->hasError()) {

                $data = [
                    'errors' => $validate->getErrors(),
                    'requests' => $this->req->getAttribute()
                ];
            } else {
                $data_user = [
                    'first_name' => $this->req->first_name,
                    'user_name' => $this->req->user_name,
                    'password' => $this->req->password,
                    'email' => $this->req->email,
                    'profile' => isset($this->req->profile['name']) ? $this->req->profile['name'] : '',
                    'profile_path' => isset($this->req->profile['tmp_name']) ? $this->req->profile['tmp_name'] : ''
                ];

                move_uploaded_file($data_user['profile_path'], APPROOT . '/public/img/profiles/' . $data_user['profile']);
                
                if ($this->userModel->insertUser($data_user) === true) {
                    redirect('users/login');
                }elseif($this->userModel->insertUser($data_user) == "exists"){
                    flash('ErrorRegisterInUser', " مشکلی پیش آمده یا کاربری از قبل با این ایمیل ایجاد شده است ", "alert alert-danger");
                }
            }
        }

        if (isset($data))
            $this->view("users/register", $data);
        else
            $this->view("users/register");
    }

    public function logout()
    {
        if (Auth::logoutUser()) {
            redirect("");
        } else {
            redirect("users/userPanel");
        }
    }
}
