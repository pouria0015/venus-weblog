<?php 

/*
  * Basic Controller
  * loads the models & views
*/
namespace Libraries\Controller;
use App\models\page;

  class Controller{
    public function __construct()
    {
        
    }
    // load model

    public function model($model){
         //require model file
         require_once '../app/models/' . $model . '.php';
        $class = '\App\models\\' . $model;
         return new $class();
    }

    // load view
    public function view($view , $data = []){

        // check for view file
        if(file_exists('../views/' . $view . '.php')){

            //load view file
            require_once '../views/' . $view . '.php';
        }else{

            // view dose not exists
            die("view dose not exists");
        }
    }
  }