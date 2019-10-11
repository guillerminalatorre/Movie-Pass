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
		private $usuariosDAO;

		function __construct()
		{
			$this->usuariosDAO = new UsuarioDAO();
		}

		public function ShowRegisterView()
		{
			require_once(VIEWS_PATH."add-usuario.php");
		}

		public function ShowListView()
		{
			$usuarioList = $this->UsuariosDAO->getAll();

			require_once(VIEWS-PATH."usuario-list.php");
		}

		public function Register($dni, $nombre, $apellido, $email, $password, $confirmpassword)
		{
			if($password == $confirmpassword)
			{
				$id_Rol = 1;

				$usuario = new Usuario();
				$usuario->setDni($dni);
				$usuario->setNombre($nombre);
				$usuario->setApellido($apellido);
				$usuario->setEmail($email);
				$usuario->setPassword($password);
				$usuario->setId_Rol($id_Rol);
	
				$this->usuariosDAO->add($usuario);
			}
			$this->ShowAddView();
		}
	}
?>