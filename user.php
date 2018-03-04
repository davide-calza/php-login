<?php

require_once('database.php');

class User
{
    //Database connection
    private $conn;

    //ConnectDB
    //  Connect to the Database
    //  $host     = hostname
    //  $database = database name
    //  $username = username for accessing the database
    //  $password = password for accessing the database
    public function ConnectDB($host, $database, $username, $password)
    {
        try{
            $db = new Database();
            $this->conn = $db->Connect($host, $database, $username, $password);
        }
        catch (Exception $e){
            echo "Exception on database connection: " . $e->getMessage();
        }
    }

    //Query
    //  Execute a query on the database
    //  $query = query to execute
    public function Query($query)
    {
        try{
            $q = $this->conn->prepare($query);
            echo "\n" . $query;
            return $q;
        }
        catch (Exception $e){
            echo "Exception on Query execution: " . $e->getMessage();
        }
        return null;
    }
}