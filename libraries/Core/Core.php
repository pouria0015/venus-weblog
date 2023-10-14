<?php
/*
    * App Core Class
    * Create URL & Load Core Controller
    * URL Format - Controller/method/param
*/
namespace Libraries\Core;

class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();

        if (is_null($url)) {
            require_once '../app/controllers/' . $this->currentController . '.php';
            $class = 'App\controllers\\' . $this->currentController;
            $this->currentController = new $class();
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
            return;
        }
        //lock in controlllers for first value
        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {

            //if exsiest set as controllers
            $this->currentController = ucwords($url[0]);

            //unset 0 index
            unset($url[0]);
        }

        //require the Controller
        require_once '../app/controllers/' . $this->currentController . '.php';
        $class = 'App\controllers\\' . $this->currentController;
        //Init the Controller
        $this->currentController = new $class();

        //check for second part of url
        if (isset($url[1])) {

            //check to see if method exists in controller 
            if (method_exists($this->currentController, $url[1])) {

                $this->currentMethod = $url[1];

                //unset 0 index
                unset($url[1]);
            }
        }
        //Get params
        $this->params = $url ? array_values($url) : [];

        //Call a Callback with array off params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
