<?php

namespace Abeille;

class Database {
    private $host = 'mysql.hostinger.com';
    private $db_name = 'u230629828_abeille';
    private $username = 'u230629828_adm';
    private $password = 'abeille';

    public $conn;

    public function __construct() {

    }

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new \PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,$this->username,$this->password);
            $this->conn->exec('set names utf8');
        } catch(PDOException $e) {
            echo 'Connection error: ' . $e->getMessage();   
        }

        return $this->conn;
    }
}

?>