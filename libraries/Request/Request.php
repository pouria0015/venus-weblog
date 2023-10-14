<?php

/*
* Management of sent requests is a villain
*/

namespace Libraries\Request;

class Request
{

    private $attribute = [];
    private $url;
    private $method;

    public function __construct()
    {
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);

        //get protocol url
        $http_protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === "on") ? "https://" : "http://";

        //creat url
        $this->url = $http_protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        // chack request method and fetch attributes request
        if ($this->method == 'post') {
            foreach ($_POST as $key => $value) {

                $this->attribute[$this->data_sanitize($key)] = $this->data_sanitize($value);
            }

            foreach ($_FILES as $key => $value) {
                $this->attribute[$this->data_sanitize($key)] = $value;
            }
        } elseif ($this->method == 'get') {
            foreach ($_GET as $key => $value) {
                if (!is_array($key)) {
                    $this->attribute[$this->data_sanitize($key)] = $this->data_sanitize($value);
                }
            }
        }
    }

    public function __get($name)
    {

        if (array_key_exists($name, $this->attribute)) {
            return $this->attribute[$name];
        }
        return null;
    }

    public function getAttribute()
    {
        return $this->attribute;
    }
    public function getMethod()
    {
        return $this->method;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function isPostMethod()
    {
        return $this->method == 'post' ? true : false;
    }

    public function isGetMethod()
    {
        return $this->method == 'get' ? true : false;
    }

    private function data_sanitize($value)
    {
        if (!is_array($value)) {
            $value = addslashes(trim($value));
            $value = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
            $value = htmlentities($value, ENT_QUOTES);
            return $value;
        }
    }
}
