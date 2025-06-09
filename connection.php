<?php

class Database{
    public static $connection;

    public static function setUpConnection(){
        if(!isset(Database::$connection)){
            Database::$connection = new mysqli("localhost","root","shivoni@19","sheez3","3306");
        }
    
    }

    public static function iud($q){
        Database::setUpConnection();
        Database::$connection->query($q);
    }

    public static function search($q){
        Database::setUpConnection();
        $resultset = database::$connection->query($q); // used capital D by eshn sir 4 database first d
        return $resultset;
    }


}

?>