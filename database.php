<?php

class Database
{
    //Database configuration
    public $conn;

    private $host = "localhost";
    private $database = "phplogin";
    private $username = "root";
    private $password = "root";

    public function Connect()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {
            echo "\nFailed to connect to the database: " . $e->getMessage();
        }
        return $this->conn;
    }
}