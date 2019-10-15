<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:05:37
	 */
	namespace Controllers;

	use DAO\CineDAO as CineDAO;
	use Models\Cine as Cine;	
	use DAO\FuncionDao as FuncionDAO;
	use Models\Funcion as Funcion;
	
	class CineController
	{
		private $cineDAO;
		private $funcionDAO;

		public function __construct()
		{
			$this->cineDAO = new CineDAO();
			$this->funcionDAO = new FuncionDAO();
		}

		public function ShowAddView()
		{
			$resultadoAgregarCine = 4;
			require_once(VIEWS_PATH."add-cine.php");
		}

		public function ShowListView()
		{
			$cineList = $this->cineDAO->getAll();

			require_once(VIEWS_PATH."cine-list.php");
		}

		public function ShowFichaCine($nombre)
		{
			$cine = $this->cineDAO->getByNombre($nombre);

			$funciones = $this->funcionDAO->getByCine($nombre);

			require_once(VIEWS_PATH."cine-ficha.php");
		}

		public function ShowModificarCine($nombre)
		{
			$cine = $this->cineDAO->getByNombre($nombre);

			require_once(VIEWS_PATH."cine-edit.php");
		}

		public function updateCine($nombre, $direccion, $capacidad, $precio)
		{
			$cine = $this->cineDAO->getByNombre($nombre);

			if($cine != null)
			{
				// $cine->setNombre($nombre);
				$cine->setDireccion($direccion);
				$cine->setCapacidad($capacidad);
				$cine->setPrecio($precio);
				$this->cineDAO->saveData();
			}

			$this->ShowFichaCine($nombre);
		}

		public function eliminarCine($nombre)
		{
			$this->cineDAO->remove($nombre);

			$this->funcionDAO->eliminarGetByCine($nombre);

			$this->ShowListView();
		}

		public function Add($nombre, $direccion, $capacidad, $precio)
		{
			if(!$this->cineDAO->getByNombre($nombre))
			{
				$cine = new Cine();

				$cine->setNombre($nombre);
				$cine->setDireccion($direccion);
				$cine->setCapacidad($capacidad);
				$cine->setPrecio($precio);

				$this->cineDAO->add($cine);

				$this->ShowListView();
			}
			else
			{
				$this->ShowAddView();
			}
		}
	}
?>