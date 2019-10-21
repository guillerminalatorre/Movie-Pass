<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:05:38
	 */
	namespace Controllers;

	use DAO\UsuarioDAO as UsuarioDAO;
	use Models\Usuario as Usuario;
	use Config\Functions as Functions;
	use Facebook as Facebook;

	class UsuarioController
	{
		private $usuarioDAO;

		function __construct()
		{
			$this->usuarioDAO = new UsuarioDAO();
		}

		public function getUserList()
		{
			$usuarioList = $this->usuarioDAO->getAll();
			return $usuarioList;
		}

		public function getUser($email)
		{
			$usuario = $this->usuarioDAO->getByEmail($email);
			return $usuario;
		}

		public function updateUser($email, $nombre, $apellido, $dni, $previouspassword, $password, $confirmpassword, $image)
		{
			$usuario = $this->usuarioDAO->getByEmail($email);

			if($usuario != null)
			{
				// $usuario->setEmail($email);
				$usuario->setNombre($nombre);
				$usuario->setApellido($apellido);
				// $usuario->setDni($dni);
				if($usuario->getPassword() === $previouspassword)
				{
					if(($password != "") && ($confirmpassword != "") && ($password === $confirmpassword))
					{
						$usuario->setPassword($password);
					}
				}
				
				// Imagen de perfil
				try
            	{

					if($_FILES["image"]["error"] > 0)
					{
						$message = "Error: " . $_FILES["image"]["error"] . "<br>";
					}
					else
					{
						$fileName = Functions::getInstance()->escapar($_FILES["image"]["name"]);
						$tempFileName = $_FILES["image"]["tmp_name"];
						$type = $_FILES["image"]["type"];
						
						$filePath = UPLOADS_PATH.basename($fileName);
						$fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
						$imageSize = getimagesize($tempFileName);

						if($imageSize !== false)
						{
							if (move_uploaded_file($tempFileName, $filePath))
							{
								$usuario->setImage(FRONT_ROOT.UPLOADS_PATH.$fileName);
								$message = "Imagen subida correctamente";
							}
							else
								$message = "Ocurrió un error al intentar subir la imagen";
						}
						else
							$message = "El archivo no corresponde a una imágen";
					}
				}
				catch(Exception $ex)
				{
					$message = $ex->getMessage();
				}
				// Fin imagen de perfil
				
				$this->usuarioDAO->saveData();
			}
			
			Functions::getInstance()->redirect("Home","ViewProfile",$email);
		}

		public function Register($dni, $nombre, $apellido, $email, $password, $confirmpassword)
		{
			$nombre = Functions::getInstance()->escapar($nombre);
			$apellido = Functions::getInstance()->escapar($apellido);
			$email = Functions::getInstance()->escapar($email);
			$password = Functions::getInstance()->escapar($password);
			$confirmpassword = Functions::getInstance()->escapar($confirmpassword);

			if(!$this->usuarioDAO->GetByEmail($email) && !$this->usuarioDAO->GetByDni($dni) && $password == $confirmpassword)
			{
				$usuario = new Usuario();
				$usuario->setDni($dni);
				$usuario->setNombre($nombre);
				$usuario->setApellido($apellido);
				$usuario->setEmail($email);
				$usuario->setPassword($password);

				$id_Rol = 1;
				$usuario->setId_Rol($id_Rol);

				$ip = $this->getUserIp();
				$usuario->setIp($ip);

				$date = time();
				$usuario->setRegisterDate($date);

				$usuario->setImage(FRONT_ROOT.UPLOADS_PATH."avatar.png");

				$this->usuarioDAO->add($usuario);

				$this->Login($email, $password);
			}
			else
			{
				Functions::getInstance()->redirect("Home","Register");
			}
		}

		public function eliminarUsuario($email)
		{
			// Solo puede ser usada por main admin / admin / usuario de su propia cuenta
			if(($_SESSION["loggedUser"]->getId_Rol() === 2 || $_SESSION["loggedUser"]->getId_Rol() === 3 || $_SESSION["loggedUser"]->getEmail() === $email) && ($_SESSION["loggedUser"]->getId_Rol() === 3 && $_SESSION["loggedUser"]->getEmail() != $usuario->getEmail()) && ($usuario->getId_Rol() != 3))
			{
				$usuario = $this->usuarioDAO->getByEmail($email);

				$this->usuarioDAO->remove($email);

				if($_SESSION["loggedUser"]->getEmail() != $email)
				{
					Functions::getInstance()->redirect("Home","ListUsers");
				}
				else
				{
					$this->Logout();
				}
			}
		}

		public function Login($email, $password)
        {
            $usuario = $this->usuarioDAO->GetByEmail($email);

			if($usuario != null)
			{
				if($usuario->getPassword() === $password)
				{
					$this->toggleUserLoginStatus($email);

					$_SESSION["loggedUser"] = $usuario;

					Functions::getInstance()->redirect("Home","Index");
				}
				else
				{
					Functions::getInstance()->redirect("Home","Login");
				}
			}
		}

		public function getFacebookAPI()
		{
			$fb = new Facebook\Facebook([
				'app_id' => FACEBOOK_API, // Replace {app-id} with your app id
				'app_secret' => FACEBOOK_SECRET,
				'default_graph_version' => 'v3.2',
				]);
			return $fb;
		}

		public function getFacebookLoginUrl()
		{
			$fb = $this->getFacebookAPI();
			$helper = $fb->getRedirectLoginHelper();
			return $helper->getLoginUrl(PROTOCOL.WWW.FRONT_ROOT."Usuario/FacebookLogin");
		}
		
		public function FacebookLogin()
		{
			$fb = $this->getFacebookAPI();
			$helper = $fb->getRedirectLoginHelper();			
			try 
			{
				$accessToken = $helper->getAccessToken();
			} 
			catch(Facebook\Exceptions\FacebookResponseException $e) {
				// When Graph returns an error
				echo 'Graph returned an error: ' . $e->getMessage();
				exit;
			} 
			catch(Facebook\Exceptions\FacebookSDKException $e) {
				// When validation fails or other local issues
				echo 'Facebook SDK returned an error: ' . $e->getMessage();
				exit;
			}
			
			if (! isset($accessToken)) 
			{
				if ($helper->getError()) 
				{
					header('HTTP/1.0 401 Unauthorized');
					echo "Error: " . $helper->getError() . "\n";
					echo "Error Code: " . $helper->getErrorCode() . "\n";
					echo "Error Reason: " . $helper->getErrorReason() . "\n";
					echo "Error Description: " . $helper->getErrorDescription() . "\n";
				} 
				else 
				{
					header('HTTP/1.0 400 Bad Request');
					echo 'Bad request';
				}
				exit;
			}
			
			// Logged in
			echo '<h3>Access Token</h3>';
			var_dump($accessToken->getValue());
			
			// The OAuth 2.0 client handler helps us manage access tokens
			$oAuth2Client = $fb->getOAuth2Client();
			
			// Get the access token metadata from /debug_token
			$tokenMetadata = $oAuth2Client->debugToken($accessToken);
			echo '<h3>Metadata</h3>';
			var_dump($tokenMetadata);
			
			// Validation (these will throw FacebookSDKException's when they fail)
			$tokenMetadata->validateAppId(FACEBOOK_API); // Replace {app-id} with your app id
			// If you know the user ID this access token belongs to, you can validate it here
			//$tokenMetadata->validateUserId('123');
			$tokenMetadata->validateExpiration();
			
			if (! $accessToken->isLongLived()) {
				// Exchanges a short-lived access token for a long-lived one
				try 
				{
					$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
				} 
				catch (Facebook\Exceptions\FacebookSDKException $e) 
				{
					echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
					exit;
				}
				
				echo '<h3>Long-lived</h3>';
				var_dump($accessToken->getValue());
			}
			
			$_SESSION['fb_access_token'] = (string) $accessToken;
			// Fin de login de facebook. Se seteo la cookie fb_access_token con el token de acceso de facebook.

			// Hacemos una consulta de los datos del usuario.
			$facebookData = $this->GetFacebookData();

			$usuario = $this->usuarioDAO->GetByEmail($facebookData['email']);

			if($usuario != null)
			{
				//Si ya existe el usuario lo logueamos y finalizamos
				$this->toggleUserLoginStatus($facebookData['email']);

				$_SESSION["loggedUser"] = $usuario;

				Functions::getInstance()->redirect("Home","Index");
			}
			else
			{
				//Si no existe lo registramos
				$usuario = new Usuario();
				$nombre = explode(" ", $facebookData['name']);
				$usuario->setNombre($nombre[0]);
				$usuario->setApellido($nombre[1]);
				$email = $facebookData['email'];
				$usuario->setEmail($email);
				$password = random_int(100000,1000000);
				$usuario->setPassword($password);

				$id_Rol = 1;
				$usuario->setId_Rol($id_Rol);

				$ip = $this->getUserIp();
				$usuario->setIp($ip);

				$date = time();
				$usuario->setRegisterDate($date);

				$usuario->setImage("http://graph.facebook.com/".$facebookData['id']."/picture?type=square&height=200");

				//Seteamos el id de facebook
				$usuario->setFacebookId($facebookData['id']);

				$this->usuarioDAO->add($usuario);

				$this->Login($email, $password);
			}
		}

		public function GetFacebookData()
		{
			$fb = $this->getFacebookAPI();		  
			try 
			{
				// Returns a `Facebook\FacebookResponse` object
				$response = $fb->get('/me?fields=id,name,email', $_SESSION['fb_access_token']);
			} 
			catch(Facebook\Exceptions\FacebookResponseException $e) 
			{
				echo 'Graph returned an error: ' . $e->getMessage();
				exit;
			} 
			catch(Facebook\Exceptions\FacebookSDKException $e) {
				echo 'Facebook SDK returned an error: ' . $e->getMessage();
				exit;
			}
			$user = $response->getGraphUser();
			return $user;
		}
        
        public function Logout()
        {
			$email = $_SESSION["loggedUser"]->getEmail();

			$this->toggleUserLoginStatus($email);

            session_destroy();

            Functions::getInstance()->redirect("Home","Index");
		}

		public function notAdmin()
		{
			return (!isset($_SESSION["loggedUser"]) || $_SESSION["loggedUser"]->getId_Rol() === 1);
		}

		public function getUserRol($id_Rol)
		{
			switch($id_Rol)
			{
				case 1:
					$rol = "Usuario";
					break;
				case 2:
					$rol = "Admin";
					break;
				case 3:
					$rol = "Main Admin";
					break;
				default: 
					$rol = "Usuario";
			}
			return $rol;
		}

		private function getUserIp()
		{
			if (!empty($_SERVER['HTTP_CLIENT_IP']))
			{
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			}
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			{
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} 
			else
			{
				$ip = $_SERVER['REMOTE_ADDR'];
			}
			return $ip;
		}

		private function toggleUserLoginStatus($email)
		{
			$usuario = $this->usuarioDAO->getByEmail($email);

			if($usuario != null)
			{
				//Ip
				$ip = $this->getUserIp();
				$usuario->setIp($ip);

				//Ultima conexion
				$date = time();
				$usuario->setLastConnection($date);

				//Cambiar estado
				$logged = $usuario->getLoggedIn();
				$usuario->setLoggedIn(!$logged);

				$this->usuarioDAO->saveData();
			}
		}

		public function toggleAdmin($email)
		{
			// Solo puede ser usada por main admin
			if($_SESSION["loggedUser"]->getId_Rol() === 3)
			{
				$usuario = $this->usuarioDAO->getByEmail($email);

				if($usuario != null)
				{
					//Cambiar rol
					$rol = $usuario->getId_Rol();
					if($rol === 1)
					{
						$usuario->setId_Rol(2);
					}
					else if($rol === 2)
					{
						$usuario->setId_Rol(1);
					}

					$this->usuarioDAO->saveData();
				}
			}
			Functions::getInstance()->redirect("Home","ViewProfile", $email);
		}
	}
