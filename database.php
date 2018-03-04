<?php

class Database
{
    //Database configuration
    public $conn;

    //Connection
    //  Connect to MySQL database using PDO
    //  $host     = hostname
    //  $database = database name
    //  $username = username for accessing the database
    //  $password = password for accessing the database
    public function Connect($host, $database, $username, $password)
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $host . ";dbname=" . $database, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "\nConnected successfully to the database";
        }
        catch (PDOException $e) {
            echo "\nFailed to connect to the database: " . $e->getMessage();
        }
        return $this->conn;
    }
}