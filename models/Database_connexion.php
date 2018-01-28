<?php
    if(!isset($_SESSION)) session_start();
    $wwwDir = $_SERVER['DOCUMENT_ROOT'];
    require_once $wwwDir."/sunusalon/routers/route.php";
    require_once $wwwDir.DATABASE_CONNEXION_MODEL_ROUTE;
    require_once $wwwDir.DATABASE_CONNEXION_MODEL_ROUTE;
    require_once $wwwDir.DB_CONF_MODEL_ROUTE;

class Database_connexion {

    private $_PDOInstance;
    private static $_instance = NULL;

    private function __construct(){

        try{

            $opitons = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            ];
            $this->_PDOInstance = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD, $opitons);

        }
        catch(PDOException $e){
            exit($e->getMessage());
        }
        
    }


    
    public static function getInstance(){
        if(is_null(self::$_instance)) self::$_instance = new Database_connexion();
        return self::$_instance;
    }


    public function request($sql, $fields = false, $multiple = false){
        try{

            $statement = $this->_PDOInstance->prepare($sql);

            if($fields){
                foreach($fields as $key=>$value){
                    if(is_int($value)) $dataType = PDO::PARAM_INT;
                    else if(is_bool($value)) $dataType = PDO::PARAM_BOOL;
                    else if(is_null($value)) $dataType = PDO::PARAM_NULL;
                    else $dataType = PDO::PARAM_STR;

                    $statement->bindValue(':'.$key, $value, $dataType);
                }
                
            }

            $statement->execute();

            if($multiple) 
                $result['data'] = $statement->fetchAll(PDO::FETCH_ASSOC);
            else 
                $result['data'] = $statement->fetch(PDO::FETCH_ASSOC);

            $result['rowCount'] = $statement->rowCount();
            $statement->closeCursor();
            return $result;
        }
        catch(Exception $e){
            exit($e->getMessage());
        }

    }


}