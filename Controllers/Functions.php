<?php
namespace Controllers;

class Functions
{
    private function __construct()
    {
    }

    public static function redirect($controller = "Home", $method = "Index", $args = array())
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

    public static function validateData($string)
    {
        //$string = stripslashes($string);
        $string = strip_tags($string);
        $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
        return $string;
    }
}
?>