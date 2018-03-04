<?php

require_once('conf.php');

class User
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->Connection();
    }

    public function runQuery($sql)
    {
        return $this->conn->prepare($sql);
    }

    public function register($username,$email,$password)
    {
        try
        {
            $hash_pwd = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->conn->prepare("INSERT INTO users(user_name,user_email,user_pass) VALUES(:username, :email, :password)");

            $stmt->bindparam(":username", $username);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":password", $hash_pwd);

            $stmt->execute();

            return $stmt;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function login($uname,$umail,$upass)
    {
        try
        {
            $stmt = $this->conn->prepare("SELECT user_id, user_name, user_email, user_pass FROM users WHERE user_name=:uname OR user_email=:umail ");
            $stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() == 1)
            {
                if(password_verify($upass, $userRow['user_pass']))
                {
                    $_SESSION['user_session'] = $userRow['user_id'];
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function is_loggedin()
    {
        if(isset($_SESSION['user_session']))
        {
            return true;
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
    }

    public function doLogout()
    {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }
}
?>