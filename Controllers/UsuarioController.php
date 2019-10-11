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
			require_once(VIEWS_PATH. "");
		}

		public function ShowListView()
		{
			$usuarioList = $this->UsuariosDAO->getAll();

			require_once(VIEWS-PATH."");
		}

		public function Register(int $dni, string $password, string $email, string $apellido, string $nombre,int $id_Rol)
		{
			$usuario = new Usuario($dni, $password, $email, $apellido, $nombre, $id_Rol);

			$this->usuariosDAO->add($usuario);

			$this->ShowAddView();
		}
	}
?>