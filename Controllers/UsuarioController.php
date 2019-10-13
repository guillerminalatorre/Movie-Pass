<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:05:38
	 */
	namespace Controllers;

	use DAO\UsuarioDAO as UsuarioDAO;
	use Models\Usuario as Usuario;

	class UsuarioController
	{
		private $usuarioDAO;

		function __construct()
		{
			$this->usuarioDAO = new UsuarioDAO();
		}

		public function ShowLoginView()
		{
			require_once(VIEWS-PATH."login.php");
		}

		public function ShowRegisterView()
		{
			require_once(VIEWS_PATH."add-usuario.php");
		}

		public function ShowListView()
		{
			$usuarioList = $this->usuarioDAO->getAll();

			require_once(VIEWS-PATH."usuario-list.php");
		}

		public function Register($dni, $nombre, $apellido, $email, $password, $confirmpassword)
		{
			if(!$this->usuarioDAO->GetByEmail($email) && !$this->usuarioDAO->GetByDni($dni) && $password == $confirmpassword)
			{
				$id_Rol = 1;

				$usuario = new Usuario();
				$usuario->setDni($dni);
				$usuario->setNombre($nombre);
				$usuario->setApellido($apellido);
				$usuario->setEmail($email);
				$usuario->setPassword($password);
				$usuario->setId_Rol($id_Rol);

				$this->usuarioDAO->add($usuario);
			}
			$this->ShowAddView();
		}

		public function Login($email, $password)
        {
            $user = $this->usuarioDAO->GetByEmail($email);

            if(($user != null) && ($user->getPassword() === $password))
            {
				$_SESSION["loggedUser"] = $user;
				
                require_once(VIEWS_PATH."searchbar.php");
            }
            else
				$this->ShowLoginView();
        }
        
        public function Logout()
        {
            session_destroy();

            $this->ShowLoginView();
        }
	}
?>