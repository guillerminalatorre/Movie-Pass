<?php
namespace Config;

class Database {
    
    private static $instance = null;
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "moviepass";
    private $conn;

    private function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    }

    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    /**
     * Getter for Conn
     *
     * @return [type]
     */
    public function getConn()
    {
        return $this->conn;
    }
}
?>