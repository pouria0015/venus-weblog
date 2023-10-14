<?php
/*
 * PDO Database Class
 * Connect to database
 * Bind Value
 * Return rows and values
 */
namespace Libraries\Database;

class Database
{

    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct()
    {

        //set DNS
        $dns = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';charset=utf8';

        // Creat PDO instance 
        try {
            $this->dbh = new \PDO($dns, $this->user, $this->pass);
            $this->dbh->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            $this->error = $e->getMessage();
            die("Error Conection Database: " . $this->error);
        }
    }

    // Preper statment with query
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Bind value
    public function bind($param , $value){
        $this->stmt->bindParam($param , $value);
    }

    // Execute the prepared statment
    public function execute(){
        return $this->stmt->execute();
    }

    // get resulte set as array of object
    public function fetchAll(){
        $this->execute();
        return $this->stmt->fetchAll();
    }

    // get single record as object
    public function fetch(){
        $this->execute();
        return $this->stmt->fetch();
    }
    public function rowCount(){
        return $this->stmt->rowCount();
    }


    // Bind value 
    /*

        $array = [
            'name' => "pooo"
        ]
        bindArray($array);

    */
    public function bindArray($param_array)
    {
        if(count($param_array)){
            foreach($param_array as $param => $value){
                $this->bind($param, $value);
            }
            return true;
        }else{
        return false;
        }
        return false;
    }
}