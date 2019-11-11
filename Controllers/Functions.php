<?php
    namespace Controllers;
	use PHPMailer\PHPMailer as PHPMailer;	
	use PHPMailer\Exception as Exception;

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

        public static function sendEmail($shippingAddress, $subject, $body, $attachment = null)
        {
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = 0;
                $mail->isSMTP();                     
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                $mail->Host       = 'smtp.gmail.com';           // Enable SMTP authentication
                $mail->SMTPAuth   = true;                       // Send using SMTP
                $mail->Username   = 'moviepass.arg@gmail.com';  // SMTP username
                $mail->Password   = 'moviepass-2019';           // SMTP password
                $mail->SMTPSecure = 'tls';                      // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port       = 587;                        // TCP port to connect to

                //Recipients
                $mail->setFrom('moviepass@noreply.com', 'Movie Pass');
                $mail->addAddress($shippingAddress);

                // Content
                $mail->isHTML(true);                             // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = $body;
                if($attachment!=null){
                    $mail->addAttachment($attachment);
                }

                $mail->send();

                Functions::flash("El mensaje fue enviado.","success");
            } catch (Exception $e) {
                Functions::flash("El mensaje no pudo ser enviado.","danger");
            }   
        }

    }
?>