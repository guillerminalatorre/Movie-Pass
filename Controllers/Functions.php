<?php
    namespace Controllers;

    class Functions
    {
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

        public static function flash($message, $type = 'info')
        {
            if(!isset($_SESSION['flash'])) $_SESSION['flash'] = array();

            $data[0] = $message;
            $data[1] = $type;
            array_push($_SESSION['flash'], $data);
        }
    }
?>