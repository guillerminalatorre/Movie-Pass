<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:05:37
	 */
	namespace Controllers;

	use DAO\CineDAO as CineDAO;
	use Models\Cine as Cine;	
	
	class CineController
	{
		private $cineDAO;

		public function __construct()
		{
			$this->cineDAO = new CineDAO();
		}

		public function ShowAddView()
		{
			require_once(VIEWS_PATH. "");
		}

		public function ShowListView()
		{
			$cineList = $this->cineDAO->getAll();

			require_once(VIEWS-PATH."homeadmin.php");
		}

		public function Add(int $id, string $nombre, string $direccion, int $capacidad, float $precio)
		{
			$cine = new Cine();
			$cine->setId($id);
			$cine->setNombre($nombre);
			$cine->setDireccion($direccion);
			$cine->setCapacidad($capacidad);
			$cine->setPrecio($precio);

			$this->cineDAO->add($cine);

			$this->ShowAddView();
		}
	}
?>