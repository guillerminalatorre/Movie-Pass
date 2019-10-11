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
			require_once(VIEWS_PATH."add-cine.php");
		}

		public function ShowListView()
		{
			$cineList = $this->cineDAO->getAll();

			require_once(VIEWS_PATH."cine-list.php");
		}

		public function Add($nombre, $direccion, $capacidad, $precio)
		{
			$cine = new Cine();
			$cine->setNombre($nombre);
			$cine->setDireccion($direccion);
			$cine->setCapacidad($capacidad);
			$cine->setPrecio($precio);

			$this->cineDAO->add($cine);

			$this->ShowAddView();
		}
	}
?>