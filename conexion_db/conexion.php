<?php

require_once $_SERVER['DOCUMENT_ROOT']. "/gestion_vehicular/vendor/autoload.php";

class DatabaseConnection{

    private $server = "127.0.0.1";
    private $user = "admin";
    private $password = "12345678";
    private $database = "registro_vehicular";
    private $port = "27017";

    private function getConnectionString(){
        return sprintf(
            "mongodb://%s:%s@%s:%s/%s", 
            $this->user,
            $this->password,
            $this->server,
            $this->port,
            $this->database
        );
    }

    public function Connect(){
        try{
            $connectionString  = $this->getConnectionString();
            $client = new MongoDB\Client($connectionString);
            return $client->selectDatabase($this->database);
        } catch(\Throwable $exception){
            return $exception->getMessage();
        }
    }
}

$dbConnection = new DatabaseConnection();
//var_dump($dbConnection->Connect()); 

?>