<?php

/**
 * Class Database
 * Manage the database
 */
class Database
{
    /**Database connection
     * @var
     */
    public $conn;

    /**Database host
     * @var string
     */
    private $host = "localhost";

    /**Database name
     * @var string
     */
    private $database = "phplogin";

    /**Database username
     * @var string
     */
    private $username = "root";

    /**Database password
     * @var string
     */
    private $password = "root";

    /**Connect
     *
     * Connect to the database with PDO
     * @return null|PDO = returns PDO statement or null if it fails
     */
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