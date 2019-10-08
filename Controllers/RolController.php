<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:05:37
	 */

	namespace Controllers;

	use DAO\RolDAO as RolDAO;
	use Models\Rol as Rol;

	class RolController
	{
		private $rolsDAO;

		function __construct()
		{
			$this->rolsDAO = new RolDAO();
		}

		public function ShowAddView()
		{
			require_once(VIEWS_PATH. "");
		}

		public function ShowListView()
		{
			$rolList = $this->RolsDAO->getAll();

			require_once(VIEWS-PATH."");
		}

		public function Add(int $id, string $descripcion, string $nombre)
		{
			$rol = new Rol($id, $descripcion, $nombre);

			$this->rolsDAO->add($rol);

			$this->ShowAddView();
		}
	}
?>