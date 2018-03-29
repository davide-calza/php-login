<?php

require_once('database.php');

class User
{
    //Database connection
    private $conn;

    //__construct
    //  User constructor
    //  Execute a connection to the database
    public function __construct()
    {
        try{
            $db = new Database();
            $this->conn = $db->Connect();
        }
        catch (PDOException $e){
            $this->Alert("\nException on database connection: " . $e->getMessage());
        }
        catch(Exception $e)
        {
            $this->Alert("\nException on database connection: " . $e->getMessage());
        }
    }

    //Redirect
    //  Redirect the user to a specific page
    //  $url = given url for the user to be redirected
    public function Redirect($url)
    {
        header("Location: $url");
    }

    //Query
    //  Execute a query on the database
    //  $query = query to execute
    public function Query($query)
    {
        try{
            $q = $this->conn->prepare($query);
            //echo "\n" . $query;
            return $q;
        }
        catch (PDOException $e){
            $this->Alert("\nException on Query execution: " . $e->getMessage());
        }
        catch(Exception $e)
        {
            $this->Alert("\nException on Query execution: " . $e->getMessage());
        }
        return null;
    }

    //LoggedIn
    //  Check if the user is logged in or not
    public function LoggedIn()
    {
        //Check if session variable user-session is set and not null
        if(isset($_SESSION['user-session'])){
            return true;
        }
        return false;
    }

    //Register
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
            //echo "\nRegistration successful";
        }
        catch(PDOException $e)
        {
            $this->Alert("\nExcept on user registration: " . $e->getMessage());
        }
        catch(Exception $e)
        {
            $this->Alert("\nException on registration: " . $e->getMessage());
        }
        return $q;
    }

    //Login
    //  Execute a user login (already registered)
    //  It is either possible do the login with the username or the email
    //  $username = username of the user
    //  $email    = email of the user
    //  $password = password of the user
    public function Login($username,$email,$password)
    {
        try
        {
            $q = $this->Query("SELECT id, username, email, password FROM user WHERE username=:username OR email=:email ");
            $q->execute(array(':username'=>$username, ':email'=>$email));
            $row=$q->fetch(PDO::FETCH_ASSOC);
            if($q->rowCount() == 1)
            {
                if(password_verify($password, $row['password']))
                {
                    $_SESSION['user-session'] = $row['id'];
                    //echo "\nLogin successful";
                    return true;
                }
                else
                {
                    throw new Exception("Login failed");
                }
            }
        }
        catch(PDOException $e)
        {
            $this->Alert("\nException on login: " . $e->getMessage());
        }
        catch(Exception $e)
        {
            $this->Alert("\nException on login: " . $e->getMessage());
        }
        return false;
    }

    //Unregister
    //  Unregister a user
    //  $username = username of the user
    //  $email    = email of the user
    //  $password = password of the user
    public function Unregister($username,$email,$password)
    {
        try
        {
            $q = $this->Query("SELECT id, username, email, password FROM user WHERE username=:username OR email=:email ");
            $q->execute(array(':username'=>$username, ':email'=>$email));
            $row=$q->fetch(PDO::FETCH_ASSOC);
            if($q->rowCount() == 1)
            {
                if(password_verify($password, $row['password']))
                {
                    $q = $this->Query("DELETE FROM user WHERE username=:username OR email=:email ");
                    $q->bindparam(":username", $username);
                    $q->bindparam(":email", $email);
                    $q->execute();
                    //echo "\nUnregistration successful";
                    return true;
                }
                else
                {
                    throw new Exception("Unregistration failed");
                }
            }
        }
        catch(PDOException $e)
        {
            $this->Alert("\nException on unregistration: " . $e->getMessage());
        }
        catch(Exception $e)
        {
            $this->Alert("\nException on unregistration: " . $e->getMessage());
        }
        return false;
    }

    //Update
    //  Execute a user informations update
    //  $oldusername = old username of the user
    //  $oldpassword = old password of the user
    //  $oldmail     = old email of the user
    //  $username    = new username of the user
    //  $email       = new email of the user
    //  $password    = new password of the user
    public function Update($oldusername, $oldmail, $sessionpwd, $username, $email, $password){

        try
        {
            $q = $this->Query("SELECT id, username, email, password FROM user WHERE id=:id ");
            $q->execute(array(':id'=>$_SESSION['user-session']));
            $row=$q->fetch(PDO::FETCH_ASSOC);
            if($q->rowCount() == 1)
            {
                if(password_verify($sessionpwd, $row['password']))
                {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $q = $this->Query("UPDATE user SET username = :username, email = :email, password = :password WHERE username = :oldusername OR email=:oldmail");
                    $q->bindparam(":username", $username);
                    $q->bindparam(":email", $email);
                    $q->bindparam(":password", $hash);
                    $q->bindparam(":oldusername", $oldusername);
                    $q->bindparam(":oldmail", $oldmail);

                    $q->execute();
                    return true;
                }
                else
                {
                    throw new Exception("Update failed");
                }
            }
        }
        catch(PDOException $e)
        {
            $this->Alert("\nException on update: " . $e->getMessage());
        }
        catch(Exception $e)
        {
            $this->Alert("\nException on update: " . $e->getMessage());
        }
        return false;
    }

    //Logout
    //  Logout the user from the session
    public function Logout()
    {
        session_destroy();
        unset($_SESSION['user-session']);
        return true;
    }

    //Alert
    //  Show a JavaScript alert
    //  $msg = message to display
    public function Alert($msg){
        echo '<script language="javascript">';
        echo 'alert("'. $msg . '")';
        echo '</script>';
    }
}