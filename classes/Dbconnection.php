<?php

namespace classes;

use mysqli;
use PDO;
use PDOException;

class dbconnection
{
    private $host = "localhost";
    private $dbname = "traveler";
    private $username = "root";
    private $password = "";
    private $port = 3306;
    private $connection;
    public function __construct(){
        try {
        // Vytvorenie PDO objektu a pripojenie k databáze
        $this->connection = new \PDO(
            "mysql:host=$this->host;dbname=$this->dbname;port=$this->port;charset=utf8",
            $this->username,
            $this->password
        );
        // Nastavenie PDO pre zobrazenie chýb a vynucenie vyvolávania výnimiek
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo "Chyba pripojenia k databáze: " . $e->getMessage();
        }
    }   public function getConnection(){
         return $this->connection;
}

}