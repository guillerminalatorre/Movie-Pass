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

	class UsuarioController
	{
		private $usuarioDAO;

		function __construct()
		{
			$this->usuarioDAO = new UsuarioDAO();
		}

		public function ShowLoginView()
		{
			require_once(VIEWS_PATH."login.php");
		}

		public function ShowRegisterView()
		{
			require_once(VIEWS_PATH."register.php");
		}

		public function ShowAdminRegisterView()
		{
			require_once(VIEWS_PATH . "register-admin.php");
		}

		public function ShowProfileView($email)
		{
			$usuario = $this->usuarioDAO->getByEmail($email);

			require_once(VIEWS_PATH."profile.php");
		}

		public function ShowModificarUsuario($email)
		{
			$usuario = $this->usuarioDAO->getByEmail($email);

			require_once(VIEWS_PATH."profile-edit.php");
		}

		public function ShowListView()
		{
			$usuarioList = $this->usuarioDAO->getAll();

			require_once(VIEWS_PATH."usuario-list.php");
		}

		public function updateUser($email, $nombre, $apellido, $dni, $previouspassword, $password, $confirmpassword)
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
				$this->usuarioDAO->saveData();
			}

			$this->ShowProfileView($email);
		}

		public function Register($dni, $nombre, $apellido, $email, $password, $confirmpassword)
		{
			$dni = Functions::getInstance()->escapar($dni);
			$nombre = Functions::getInstance()->escapar($dni);
			$apellido = Functions::getInstance()->escapar($dni);
			$email = Functions::getInstance()->escapar($dni);
			$password = Functions::getInstance()->escapar($dni);
			$confirmpassword = Functions::getInstance()->escapar($dni);

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

				$this->usuarioDAO->add($usuario);

				$this->Login($email, $password);
			}
			else
			{
				$this->ShowRegisterView();
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
					$this->ShowListView();
				}
				else
				{
					$this->Logout();
				}
			}
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

		private function getUserRol($id_Rol)
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

		public function Login($email, $password)
        {
            $usuario = $this->usuarioDAO->GetByEmail($email);

			if($usuario != null)
			{
				if($usuario->getPassword() === $password)
				{
					$this->toggleUserLoginStatus($email);

					$_SESSION["loggedUser"] = $usuario;
					
					header("Location: ".FRONT_ROOT."Pelicula/ShowMovies");
				}
				else
				{
					$this->ShowLoginView();
				}
			}
        }
        
        public function Logout()
        {
			$email = $_SESSION["loggedUser"]->getEmail();

			$this->toggleUserLoginStatus($email);

            session_destroy();

            header("Location: ".FRONT_ROOT."Pelicula/ShowMovies");
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
			$this->ShowProfileView($email);
		}
	}
