<?php
/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:05:38
 */
namespace Controllers;

use API\FBController as FBController;
use DAO\UsuarioDAO as UsuarioDAO;
use Models\Usuario as Usuario;
use Facebook as Facebook;

class UsuarioController extends Administrable
{
	private $usuarioDAO;

	function __construct()
	{
		$this->usuarioDAO = new UsuarioDAO();
	}

	public function ShowProfileView($id)
	{
		if(!$this->loggedIn()) Functions::redirect("Home");
		if($id != $_SESSION["loggedUser"]->getId() && !$this->isAdmin()) Functions::redirect("Home");

		$usuario = new Usuario();
		$usuario->setId($id);
		$usuario = $this->usuarioDAO->getUsuario($usuario);
		require_once(VIEWS_PATH."usuario/profile.php");
	}

	public function ShowEditView($id)
	{
		if(!$this->loggedIn()) Functions::redirect("Home");
		if($id != $_SESSION["loggedUser"]->getId() && !$this->isAdmin()) Functions::redirect("Home");

		$usuario = new Usuario();
		$usuario->setId($id);
		$usuario = $this->usuarioDAO->getUsuario($usuario);
		require_once(VIEWS_PATH."usuario/profile-edit.php");
	}

	public function ShowListView()
	{
		if(!$this->loggedIn()) Functions::redirect("Home");
		if(!$this->isAdmin()) Functions::redirect("Home");

		$usuarioList = $this->usuarioDAO->getAll();
		require_once(VIEWS_PATH."usuario/usuario-list.php");
	}

	public function updateUser($email, $nombre, $apellido, $dni, $previouspassword, $password, $confirmpassword)
	{
		if(!$this->loggedIn()) Functions::redirect("Home");
		if(!$this->isAdmin()) Functions::redirect("Home");
		if($id != $_SESSION["loggedUser"]->getId() && !$this->isAdmin()) Functions::redirect("Home");

		$_SESSION['flash'] = array();

		$email = Functions::validateData($email);
		$nombre = Functions::validateData($nombre);
		$apellido = Functions::validateData($apellido);		
		$previouspassword = Functions::validateData($previouspassword);
		$password = Functions::validateData($password);
		$confirmpassword = Functions::validateData($confirmpassword);

		$usuario = $this->usuarioDAO->getByEmail($email);
		if($usuario == null)
		{
			array_push($_SESSION['flash'], "El usuario no existe.");
			Functions::redirect("Home");
		}

		$usuario->setNombre($nombre);
		$usuario->setApellido($apellido);
		$usuario->setDni($dni);
		if($usuario->getPassword() === $previouspassword)
		{
			if(($password != "") && ($confirmpassword != ""))
			{
				if($password === $confirmpassword)
				{
					$usuario->setPassword($password);
				}			
				else
				{
					array_push($_SESSION['flash'], "Las password nuevas no coinciden.");
				}
			}
		}
		else
		{
			array_push($_SESSION['flash'], "La password ingresada es incorrecta.");
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
				$fileName = Functions::validateData($_FILES["image"]["name"]);
				$tempFileName = $_FILES["image"]["tmp_name"];
				$type = $_FILES["image"]["type"];
				
				$filePath = UPLOADS_PATH.basename($fileName);
				$fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
				$imageSize = getimagesize($tempFileName);

				if($imageSize !== false)
				{
					if (move_uploaded_file($tempFileName, $filePath))
					{
						$usuario->setImage(UPLOADS_PATH.$fileName);
						array_push($_SESSION['flash'], "Imagen subida correctamente.");
					}
					else
						array_push($_SESSION['flash'], "Ocurrió un error al intentar subir la imagen.");
				}
				else
					array_push($_SESSION['flash'], "El archivo no corresponde a una imágen.");
			}
		}
		catch(Exception $ex)
		{
			array_push($_SESSION['flash'], $ex->getMessage());
		}
		// Fin imagen de perfil

		$this->usuarioDAO->edit($usuario);
		array_push($_SESSION['flash'], "Los datos se han guardado correctamente.");		
		Functions::redirect("Usuario","ShowProfileView", $usuario->getId());
	}

	public function Register($email, $nombre, $apellido, $dni = null, $password, $confirmpassword, $facebookId = null)
	{
		$_SESSION['flash'] = array();
		if($this->loggedIn()) Functions::redirect("Home");

		$usuario = $this->usuarioDAO->getByEmail($email);
		if($usuario != null)
		{
			array_push($_SESSION['flash'], "El usuario ya existe.");
			Functions::redirect("Register");
		}

		$email = Functions::validateData($email);
		$nombre = Functions::validateData($nombre);
		$apellido = Functions::validateData($apellido);		
		$password = Functions::validateData($password);
		$confirmpassword = Functions::validateData($confirmpassword);
		if($password != $confirmpassword)
		{
			array_push($_SESSION['flash'], "Las password ingresadas no coinciden.");
			Functions::redirect("Register");
		}

		$usuario = new Usuario();
		$usuario->setEmail($email);					
		$usuario->setNombre($nombre);
		$usuario->setApellido($apellido);
		if($dni != null) $usuario->setDni($dni);
		$usuario->setPassword($password);

		$id_Rol = 1;
		$usuario->setId_Rol($id_Rol);

		$ip = $this->getUserIp();
		$usuario->setIp($ip);

		$date = time();
		$usuario->setRegisterDate($date);
		$usuario->setLoggedIn(0);

		if($facebookId != null)
		{
			$usuario->setFacebookId($facebookId);
			$usuario->setImage("https://graph.facebook.com/".$facebookId."/picture?type=square&height=200");
		}
		else
		{
			$usuario->setImage(IMG_PATH."avatar.png");
		}

		$this->usuarioDAO->add($usuario);

		$this->Login($email, $password);
	}

	public function Remove($id)
	{
		$_SESSION['flash'] = array();
		if(($this->isAdmin() && $id != $_SESSION["loggedUser"]->getId()) || (!$this->isAdmin() && $id == $_SESSION["loggedUser"]->getId()))
		{
			$usuario = new Usuario();
			$usuario->setId($id);
			$usuario = $this->usuarioDAO->getUsuario($usuario);

			$this->usuarioDAO->remove($usuario);

			if($_SESSION["loggedUser"]->getId() != $id)
			{
				array_push($_SESSION['flash'], "El usuario seleccionado fue eliminado.");
				Functions::redirect("Usuario","ShowListView");
			}
			else
			{
				array_push($_SESSION['flash'], "Tu cuenta ha sido borrada satisfactoriamente.");
				$this->Logout();
			}
		}
	}

	public function Login($email, $password)
	{
		$_SESSION['flash'] = array();
		if($this->loggedIn()) Functions::redirect("Home");

		$usuario = $this->usuarioDAO->getByEmail($email);
		if($usuario == null || $usuario->getPassword() != $password)
		{
			array_push($_SESSION['flash'], "Email o password incorrecto.");
			Functions::redirect("Login");
		}

		$this->toggleUserLoginStatus($usuario);

		$_SESSION["loggedUser"] = $usuario;

		array_push($_SESSION['flash'], "Login exitoso. Disfruta tu estadia.");
		Functions::redirect("Home");
	}

	public function FacebookLogin()
	{
		$_SESSION['flash'] = array();

		$fb = FBController::getFacebookAPI();
		$helper = $fb->getRedirectLoginHelper();
		try 
		{
			$accessToken = $helper->getAccessToken();
		} 
		catch(Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			array_push($_SESSION['flash'], 'Graph returned an error: ' . $e->getMessage());
			Functions::redirect("Login");
		} 
		catch(Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			array_push($_SESSION['flash'], 'Facebook SDK returned an error: ' . $e->getMessage());
			Functions::redirect("Login");
		}
		
		if (! isset($accessToken)) 
		{
			if ($helper->getError()) 
			{
				header('HTTP/1.0 401 Unauthorized');
				array_push($_SESSION['flash'], "Error: " . $helper->getError());
				array_push($_SESSION['flash'], "Error Code: " . $helper->getErrorCode());
				array_push($_SESSION['flash'], "Error Reason: " . $helper->getErrorReason());
				array_push($_SESSION['flash'], "Error Description: " . $helper->getErrorDescription());
			} 
			else 
			{
				header('HTTP/1.0 400 Bad Request');
				array_push($_SESSION['flash'], 'Bad request');
			}
			Functions::redirect("Login");
		}
		
		// Logged in
		//echo '<h3>Access Token</h3>';
		//var_dump($accessToken->getValue());
		
		// The OAuth 2.0 client handler helps us manage access tokens
		$oAuth2Client = $fb->getOAuth2Client();
		
		// Get the access token metadata from /debug_token
		$tokenMetadata = $oAuth2Client->debugToken($accessToken);
		//echo '<h3>Metadata</h3>';
		//var_dump($tokenMetadata);
		
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
				array_push($_SESSION['flash'], "Error getting long-lived access token: " . $e->getMessage());
				Functions::redirect("Login");
			}
			
			echo '<h3>Long-lived</h3>';
			var_dump($accessToken->getValue());
			Functions::redirect("Login");
		}
		
		$_SESSION['fb_access_token'] = (string) $accessToken;
		// Fin de login de facebook. Se seteo la cookie fb_access_token con el token de acceso de facebook.

		// Hacemos una consulta de los datos del usuario.
		$facebookData = $this->GetFacebookData();

		$usuario = $this->usuarioDAO->GetByEmail($facebookData['email']);

		if($usuario != null)
		{
			$this->Login($usuario->getEmail(), $usuario->getPassword());
		}
		else
		{
			$nombre = explode(" ", $facebookData['name']);
			$password = random_int(100000,1000000);
			$this->Register($facebookData['email'], $nombre[0], $nombre[1], null, $password, $password, $facebookData['id']);
		}
	}

	private function GetFacebookData()
	{
		$fb = FBController::getFacebookAPI();		  
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
		$_SESSION['flash'] = array();
		if(!$this->loggedIn()) Functions::redirect("Home");

		$email = $_SESSION["loggedUser"]->getEmail();
		$_SESSION["loggedUser"] = $this->toggleUserLoginStatus($_SESSION["loggedUser"]);
		$this->usuarioDAO->edit($_SESSION["loggedUser"]);
		unset($_SESSION["loggedUser"]);
		
		array_push($_SESSION['flash'], "Logout exitoso. Hasta pronto.");
		Functions::redirect("Home");
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
	
	private function toggleUserLoginStatus($usuario)
	{
		//Ip
		$ip = $this->getUserIp();
		$usuario->setIp($ip);

		//Ultima conexion
		$date = time();
		$usuario->setLastConnection($date);

		//Cambiar estado
		$usuario->getLoggedIn() ? $usuario->setLoggedIn(0) : $usuario->setLoggedIn(1);

		return $usuario;
	}	

	public function toggleAdmin($email)
	{
		$_SESSION['flash'] = array();
		if($this->isMainAdmin())
		{
			$usuario = $this->usuarioDAO->getUsuario($email);

			if($usuario != null)
			{
				//Cambiar rol
				$usuario->getId_Rol() == 1 ? $usuario->setId_Rol(2) : $usuario->setId_Rol(1);
				$this->usuarioDAO->edit($usuario);
			}
		}
		array_push($_SESSION['flash'], "Se han cambiado los accesos de ".$usuario->getNombre().$usuario->getApellido().".");
		Functions::redirect("Usuario","ShowProfileView", $usuario->getId());
	}
}
?>