<?php
namespace Config;

class Functions
{
    private static $instance = null;
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

    public function redirect($controller = "Home", $method = "Index", $args = array())
    {
        if(is_array($args))
        {
            $location = FRONT_ROOT . $controller . "/" . $method . "/" . implode("/",$args);
        }
        else
        {
            $location = FRONT_ROOT . $controller . "/" . $method . "/" . $args;
        }
        
        header("Location: " . $location);
        exit;
    }

    public function escapar($string)
    {
        //$string = stripslashes($string);
        $string = strip_tags($string);
        $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
        $string = mysqli_real_escape_string(Database::getInstance()->getConn(), $string);
        return $string;
    }
}
?>