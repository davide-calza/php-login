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
        catch (PDOException $e){
            echo "\nException on database connection: " . $e->getMessage();
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
        catch (PDOException $e){
            echo "\nException on Query execution: " . $e->getMessage();
        }
        return null;
    }


    //Login
    //  Execute a user registration
    //  $username = username of the user
    //  $email    = email of the user
    //  $password = password of the user
    public function Register($username,$email,$password)
    {
        $q = null;
        try
        {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $q = $this->Query("INSERT INTO user(username,email,password) VALUES(:username, :email, :password)");
            $q->bindparam(":username", $username);
            $q->bindparam(":email", $email);
            $q->bindparam(":password", $hash);
            $q->execute();

            echo "\nRegistration successful";
        }
        catch(PDOException $e)
        {
            echo "\nExcept on user registration: " . $e->getMessage();
        }
        return $q;
    }
}