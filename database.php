<?php

class Database
{
    public $conn; // Database connection

    private $host = "localhost";    //Database host
    private $database = "phplogin"; //Database name
    private $username = "root";     //Database username
    private $password = "root";     //Database password

    //Connect to the database with PDO
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