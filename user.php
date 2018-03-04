<?php

require_once('database.php');

class User
{
    //Database connection
    private $conn;

    //ConnectDB
    //  Connect to the Database
    //  $host = hostname
    //  $database = database name
    //  $username = username for accessing the database
    //  $password = password for accessing the database
    public function ConnectDB($host, $database, $username, $password)
    {
        $db = new Database();
        $this->conn = $db->Connect($host, $database, $username, $password);
    }
}
?>