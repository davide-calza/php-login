<?php

require_once('database.php');

/**
 * Class User
 * Manage User functions (Login, Logout, CRUD)
 */
class User
{
    /**
     * @var null|PDO
     * Database connection
     */
    private $conn;

    /**__construct
     *
     * User constructor
     * Execute a connection to the database
     */
    public function __construct()
    {
        try {
            $db = new Database();
            $this->conn = $db->Connect();
        } catch (PDOException $e) {
            $this->Alert("\nException on database connection: " . $e->getMessage());
        } catch (Exception $e) {
            $this->Alert("\nException on database connection: " . $e->getMessage());
        }
    }

    /**Redirect
     *
     * Redirect the user to a specific page
     * @param $url = given url for the user to be redirected
     */
    public function Redirect($url)
    {
        header("Location: $url");
    }

    /**Query
     *
     * Execute a query on the database
     * @param $query              = query to execute
     * @return null|PDOStatement  = return the PDO statement or null if it fails
     */
    public function Query($query)
    {
        try {
            $q = $this->conn->prepare($query);
            return $q;
        } catch (PDOException $e) {
            $this->Alert("\nException on Query execution: " . $e->getMessage());
        } catch (Exception $e) {
            $this->Alert("\nException on Query execution: " . $e->getMessage());
        }
        return null;
    }

    /**LoggedIn
     *
     * Determine if the user is logged in or not
     * by checking if session variable user-session is set and not null
     * @return bool = true if the user is logged in
     */
    public function LoggedIn()
    {
        if (isset($_SESSION['user-session'])) {
            return true;
        }
        return false;
    }

    /**Register
     *
     * Execute a user registration
     * @param $username          = username of the user
     * @param $email             = email of the user
     * @param $password          = password of the user
     * @return null|PDOStatement = return the PDO statement or null if it fails
     */
    public function Register($username, $email, $password)
    {
        $q = null;
        try {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $q = $this->Query("INSERT INTO user(username,email,password) VALUES(:username, :email, :password)");
            $q->bindparam(":username", $username);
            $q->bindparam(":email", $email);
            $q->bindparam(":password", $hash);
            $q->execute();
        } catch (PDOException $e) {
            $this->Alert("\nExcept on user registration: " . $e->getMessage());
        } catch (Exception $e) {
            $this->Alert("\nException on registration: " . $e->getMessage());
        }
        return $q;
    }

    /**Login
     *
     * Execute a user login (already registered)
     * It is either possible do the login with the username or the email
     * @param $username  = username of the user
     * @param $email     = email of the user
     * @param $password  = password of the user
     * @return bool      = true if successful
     */
    public function Login($username, $email, $password)
    {
        try {
            $q = $this->Query("SELECT id, username, email, password FROM user WHERE username=:username OR email=:email ");
            $q->execute(array(':username' => $username, ':email' => $email));
            $row = $q->fetch(PDO::FETCH_ASSOC);
            if ($q->rowCount() == 1) {
                if (password_verify($password, $row['password'])) {
                    $_SESSION['user-session'] = $row['id'];
                    //echo "\nLogin successful";
                    return true;
                } else {
                    throw new Exception("Login failed");
                }
            }
        } catch (PDOException $e) {
            $this->Alert("\nException on login: " . $e->getMessage());
        } catch (Exception $e) {
            $this->Alert("\nException on login: " . $e->getMessage());
        }
        return false;
    }

    /**Unregister
     *
     * Unregister a user
     * @param $username   = username of the user
     * @param $email      = email of the user
     * @param $sessionpwd = password of the user
     * @return bool       = true if successful
     */
    public function Unregister($username, $email, $sessionpwd)
    {
        try {
            if ($this->CheckCredentials($sessionpwd)) {
                $q = $this->Query("DELETE FROM user WHERE username=:username OR email=:email ");
                $q->bindparam(":username", $username);
                $q->bindparam(":email", $email);
                $q->execute();
                return true;
            } else {
                throw new Exception("Unregistration failed");
            }
        } catch (PDOException $e) {
            $this->Alert("\nException on unregistration: " . $e->getMessage());
        } catch (Exception $e) {
            $this->Alert("\nException on unregistration: " . $e->getMessage());
        }
        return false;
    }


    /**Update
     *
     * Execute a user informations update
     * @param $oldusername = old username of the user
     * @param $oldmail     = old email of the user
     * @param $sessionpwd  = password of the session user
     * @param $username    = new username of the user
     * @param $email       = new email of the user
     * @param $password    = new password of the user
     * @return bool        = true if successful
     */
    public function Update($oldusername, $oldmail, $sessionpwd, $username, $email, $password)
    {
        try {
            if ($this->CheckCredentials($sessionpwd)) {
                if($password == "" || $password == null){
                    $q = $this->Query("UPDATE user SET username = :username, email = :email WHERE username = :oldusername OR email=:oldmail");
                }
                else{
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $q = $this->Query("UPDATE user SET username = :username, email = :email, password = :password WHERE username = :oldusername OR email=:oldmail");
                    $q->bindparam(":password", $hash);
                }
                $q->bindparam(":username", $username);
                $q->bindparam(":email", $email);
                $q->bindparam(":oldusername", $oldusername);
                $q->bindparam(":oldmail", $oldmail);
                $q->execute();
                return true;
            } else {
                throw new Exception("Update failed");
            }
        } catch (PDOException $e) {
            $this->Alert("\nException on update: " . $e->getMessage());
        } catch (Exception $e) {
            $this->Alert("\nException on update: " . $e->getMessage());
        }
        return false;
    }

    /**Add
     *
     * Execute an external user registration
     * @param $sessionpwd  = password of the session user
     * @param $username    = new username of the user
     * @param $email       = new email of the user
     * @param $password    = new password of the user
     * @return bool        = true if successful
     */
    public function Add($sessionpwd, $username, $email, $password)
    {
        try {
            if ($this->CheckCredentials($sessionpwd)) {
                $this->Register($username, $email, $password);
                return true;
            } else {
                throw new Exception("Add user failed");
            }
        } catch (PDOException $e) {
            $this->Alert("\nException on register: " . $e->getMessage());
        } catch (Exception $e) {
            $this->Alert("\nException on register: " . $e->getMessage());
        }
        return false;
    }

    /**Logout
     *
     * Logout the user from the session
     * @return bool = true if successful
     */
    public function Logout()
    {
        session_destroy();
        unset($_SESSION['user-session']);
        return true;
    }

    /**Alert
     *
     * Show a JavaScript alert
     * @param $msg = message to display
     */
    public function Alert($msg)
    {
        echo '<script language="javascript">';
        echo 'alert("' . $msg . '")';
        echo '</script>';
    }

    /**CheckCredentials
     *
     * Check if the password is coincident with session user's password
     * @param $sessionpwd = password of the session user
     * @return bool       = true if successful
     */
    private function CheckCredentials($sessionpwd)
    {
        $q = $this->Query("SELECT id, username, email, password FROM user WHERE id=:id ");
        $q->execute(array(':id' => $_SESSION['user-session']));
        $row = $q->fetch(PDO::FETCH_ASSOC);
        if ($q->rowCount() == 1) {
            if (password_verify($sessionpwd, $row['password'])) {
                return true;
            }
        }
        return false;
    }
}