<?php
namespace Config;

class Functions
{
    private static $instance = null;
    private $message = null;
    private $displayed = null;

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new Functions();
        }
        return self::$instance;
    }

    /**
     * Getter for Message
     *
     * @return [type]
     */
    public function getMessage()
    {
        return $this->message;
    }

    public function escapar($string)
    {
        $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
        $string = stripslashes($string);
        // $string = mysqli_real_escape_string(Database::getInstance()->getConn(), $string);
        return $string;
    }

    public function message($string)
    {
        echo $string;
    }
}
?>