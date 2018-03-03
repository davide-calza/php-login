<?php
class Database
{
    private $host = "localhost";
    private $database = "phplogin";
    private $username = "root";
    private $password = "root";
    public $conn;

    public function Connection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $exception) {
            echo "Exception on database connection: " . $exception->getMessage();
        }
        return $this->conn;
    }
}