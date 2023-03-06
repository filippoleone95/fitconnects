<?php

class Database  {
    private $host;
    private $username;
    private $password;
    private $database;

    private $db;

    public function __construct($host , $user , $pass , $db )
    {
        $this->host = $host;
        $this->username = $user;
        $this->password = $pass;
        $this->database = $db;

        //$dns = 'mysql:dbname=' . $this->database . ';host=' . $this->host;
        $dns = 'mysql:dbname=' . $this->database . ';host=' . $this->host . ';charset=utf8mb4';

        // Create connection
        try{
            $db = new PDO($dns, $this->username, $this->password);
            $this->db = $db;
            //$db = new PDO('mysql:dbname='.$this->nomedb.'; host='.$this->servername.'; charset=utf8mb4', $this->username, $this->password);
            
            /* $conn = new PDO('mysql:host='.$this->servername.'; dbname='.$this->nomedb.'; charset=utf8mb4', $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db = $conn;
            echo "Connessione stabilita con il database"; */


            //$this->db  = $db;
        }
        catch(PDOException $Exception) {
            echo "Errore nella connessione con il database: " . $Exception->getMessage();
            //throw new PDOException( $Exception->getMessage( ) , $Exception->getCode( ) );
        }

    }

    public function getPDO(){
        return   $this->db;
    }

    public function count($sql){
        $res = $this->db->query($sql);
        $count = $res->fetchColumn();  
        return $count ;    
    }

}




?>