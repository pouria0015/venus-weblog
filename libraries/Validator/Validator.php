<?php

/*
*   Validation of forms and inputs
*   The output of validation auxiliary functions is in such a way that if there is an error, they return 1, otherwise 0 or false.
*/

namespace Libraries\Validator;

class Validator
{

    private $errors = [];
    private $request;

    public function __construct($requestObject)
    {
        $this->request = $requestObject;
    }

    public function Validate($array)
    {

        foreach ($array as $field => $rules) {

            foreach ($rules as $rule) {

                // Checking The Existence : in The Law 
                // You can also use the str_contains function if your PHP version is higher than 8 
                if (strpos($field, ':')) {

                    $fieldArray = explode(':', $field);
                    $arrayName = $fieldArray[0];
                    $key = $fieldArray[1];
                    if (isset($this->request->{$arrayName}[$key]) && !empty($this->request->{$arrayName}[$key])) {

                    if (strpos($rule, ':')) {
                       
                        $rule = explode(':', $rule);
                        $ruleName = $rule[0];
                        $ruleValue = $rule[1];

                        if ($error = $this->{$ruleName}($this->request->{$arrayName}[$key], $ruleValue)) {
                            $this->errors[array_keys($this->request->$arrayName , $this->request->{$arrayName}[$key])[0]] = $error;
                            break;
                        }
                    } else {
                        if ($error = $this->{$rule}($this->request->{$arrayName}[$key])) {
                            $this->errors[array_keys($this->request->$arrayName , $this->request->{$arrayName}[$key])[0]] = $error;
                            break;
                        }
                    } 
                }
                } else {

                    if (strpos($rule, ':')) {

                        $rule = explode(':', $rule);
                        $ruleName = $rule[0];
                        $ruleValue = $rule[1];

                        if ($error = $this->{$ruleName}($field, $ruleValue)) {
                            $this->errors[$field] = $error;
                            break;
                        }
                    } else {

                        if ($error = $this->{$rule}($field)) {
                            $this->errors[$field] = $error;
                            break;
                        }
                    }
                }
            }
        }
        return $this;
    }

    public function hasError()
    {
        return count($this->errors) ? true : false;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    private function required($field)
    {

        if ($this->request->{$field} !== null) {
          
            return false;
        
        } elseif (is_null($field) || empty($field) || $field == '') {
            return true;
        } else {
            return false;
            
        }
        return false;
    }

    // If the lenth desired string is less than the value, it will set the error field to 1
    private function minStr($field, $value)
    {
        if ($this->request->{$field} !== null) {

            if (strlen($this->request->{$field}) < $value) {
                return true;
            } else {
                return false;
            }
        } else {

            if ($field !== null) {

                if (strlen($field) < $value) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    // If the lenth desired string is greater than the value, it will set the error field to 1
    private function maxStr($field, $value)
    {
        if ($this->request->{$field} !== null) {

            if (strlen((string)$this->request->{$field}) >  $value) {
                return true;
            } else {
                return false;
            }
        } else {
            if (strlen((string)$field) >  $value) {
                return true;
            } else {
                return false;
            }
        }
    }

    // If the lenth desired number is less than the value, it will set the error field to 1
    private function minNumberLenth($field, $count)
    {
        if (strlen((string)($this->request->{$field})) < $count) {
            return true;
        }
        return false;
    }

    // If the lenth desired number is greater than the value, it will set the error field to 1
    private function maxNumberLenth($field, $count)
    {
        if (strlen((string)($this->request->{$field})) > $count) {
            return true;
        }
        return false;
    }

    // If the desired number is greater than the value, it will set the error field to 1
    private function maxNumber($field, $count)
    {
        if ($this->request->{$field} > $count) {
            return true;
        }
        return false;
    }

    // If the desired number is less than the value, it will set the error field to 1
    private function minNumber($field, $count)
    {
        if ($this->request->{$field} < $count) {
            return true;
        }
        return false;
    }



    private function email($field)
    {
        return preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", filter_var($this->request->{$field}, FILTER_SANITIZE_EMAIL)) ? FALSE : TRUE;
    }

    // The value must be a numeric data type
    private function isNumberInt($field)
    {
        if (is_int(filter_var($this->request->{$field}, FILTER_SANITIZE_NUMBER_INT))) {
            return false;
        }
        return true;
    }

    // The value must be a decimal data type
    private function isNumberFloat($field)
    {
        if (is_float($this->request->{$field})) {
            return false;
        }
        return true;
    }

    // The data type is not important and can be a string with numbers
    private function isNumber($field)
    {
        if (is_numeric($this->request->{$field})) {
            return false;
        }
        return true;
    }


    // If the number of decimals of a decimal number is greater than the desired value, it returns the value of 1
    private function maxFloatLenth($field, $count)
    {
        $str_num = (string)$this->request->{$field};
        $dot_pos = strpos($str_num, ".");
        $num_decimals = strlen($str_num) - $dot_pos - 1;

        if ($num_decimals > $count) {
            return true;
        }
        return false;
    }

    //If the number of decimals is one decimal number smaller than the desired value, it returns the value of 1  
    private function minFloatLenth($field, $count)
    {
        $str_num = (string)$this->request->{$field};
        $dot_pos = strpos($str_num, ".");
        $num_decimals = strlen($str_num) - $dot_pos - 1;

        if ($num_decimals < $count) {
            return true;
        }
        return false;
    }


    private function confirm($field)
    {
        $name_confirm = $field . "_confirm";
        $confirm = $this->request->{$name_confirm};
        if (is_null($confirm) || !isset($confirm) || empty($confirm)) {
            return true;
        } elseif ($this->request->{$field} !== $this->request->{$name_confirm}) {
            return true;
        }
        return false;
    }

    // suffix value = "image or video or pdf or word or audio or ....
    // field value = "file name"

    // application/pdf:  PDF
    // image/jpeg:  JPEG
    // image/png:  PNG
    // image/gif:  GIF
    // audio/mpeg:   MP3
    // video/mp4:   MP4
    // application/zip:   ZIP
    // application/vnd.ms-excel:   Microsoft Excel
    // application/msword:  Word Microsoft Word
    // application/octet-stream: binary data 

    public function FileSuffix($field, $suffix)
    {

        switch (pathinfo($field, PATHINFO_EXTENSION)) {
            case "jpeg":
                return ($suffix != "jpeg") ? true : false;
                break;
            case "png":
                return ($suffix != "png") ? true : false;
                break;
            case "jpg":
                return ($suffix != "jpg") ? true : false;
                break;
            case "mp4":
                return ($suffix != "mp4") ? true : false;
                break;
            case "mpeg":
                return ($suffix != "mpeg") ? true : false;
                break;
            case "mp3":
                return ($suffix != "mp3") ? true : false;
                break;
            default:
            return true;
        }
        return true;
    }

    public function fileMinSize($field, $KB_size)
    {

        $size = $this->ByteToKb($field);

        if ($size < $KB_size) {
            return true;
        } else {
            return false;
        }
        return false;
    }
    public function fileMaxSize($field, $KB_size)
    {
        $size = $this->ByteToKb($field);

        if ($size > $KB_size) {
            return true;
        } else {
            return false;
        }
        return false;
    }

    function ByteToKb($size)
    {
        $base = log($size) / log(1024);
        $f_base = floor($base);
        return round(pow(1024, $base - floor($base)), 1);
    }

    function chackCsrfToken($csrf_token){

        $token = getCsrfToken();
        if($token == $csrf_token){
            deleteCsrfToken();
            return true;
        }else{
            return false;
        }

    }
}
