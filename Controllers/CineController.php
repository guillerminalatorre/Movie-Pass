<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:05:37
	 */
	namespace Controllers;

	use DAO\CineDAO as CineDAO;
	use DAO\FuncionDAO as FuncionDAO;
	use Models\Cine as Cine;
	use Config\Functions as Functions;	
	
	class CineController
	{
		private $cineDAO;

		public function __construct()
		{
			$this->cineDAO = new CineDAO();
			$this->funcionDAO = new FuncionDAO();
		}

		public function ShowListView()
		{
			$cineList = $this->cineDAO->getAll();
			require_once(VIEWS_PATH."cine/cine-list.php");
		}

		public function ShowAddView()
		{
			require_once(VIEWS_PATH."cine/add-cine.php");
		}

		public function ShowFichaView($nombre)
		{
			$cine = $this->cineDAO->getByNombre($nombre);
			$funcionList = $this->funcionDAO->getByCine($nombre);
			require_once(VIEWS_PATH."cine/cine-ficha.php");
		}

		public function ShowEditView($nombre)
		{
			$cine = $this->cineDAO->getByNombre($nombre);
			require_once(VIEWS_PATH."cine/cine-edit.php");
		}

		public function updateCine($nombre, $direccion, $capacidad, $precio)
		{
			$_SESSION['flash'] = array();

			$nombre = Functions::getInstance()->escapar($nombre);
			$nombre = Functions::getInstance()->escapar($direccion);
			$nombre = Functions::getInstance()->escapar($capacidad);
			$nombre = Functions::getInstance()->escapar($precio);

			$cine = $this->cineDAO->getByNombre($nombre);

			if($cine != null)
			{
				// $cine->setNombre($nombre);
				$cine->setDireccion($direccion);
				$cine->setCapacidad($capacidad);
				$cine->setPrecio($precio);
				$this->cineDAO->saveData();
				array_push($_SESSION['flash'], "Los datos se han actualizado correctamente.");
			}
			else
			{
				array_push($_SESSION['flash'], "El cine no existe.");
			}

			Functions::getInstance()->redirect("Cine","ShowFichaView",$nombre);
		}

		public function eliminarCine($nombre)
		{
			$_SESSION['flash'] = array();
			$this->cineDAO->remove($nombre);			
			$this->funcionDAO->removeByCine($nombre);

			array_push($_SESSION['flash'], "El cine se ha eliminado correctamente.");
			Functions::getInstance()->redirect("Cine","ShowListView");
		}

		public function Add($nombre, $direccion, $capacidad, $precio)
		{
			$_SESSION['flash'] = array();
			
			$nombre = Functions::getInstance()->escapar($nombre);
			$nombre = Functions::getInstance()->escapar($direccion);
			$nombre = Functions::getInstance()->escapar($capacidad);
			$nombre = Functions::getInstance()->escapar($precio);

			if(!$this->cineDAO->getByNombre($nombre))
			{
				$cine = new Cine();
				$cine->setNombre($nombre);
				$cine->setDireccion($direccion);
				$cine->setCapacidad($capacidad);
				$cine->setPrecio($precio);
				$this->cineDAO->add($cine);
				array_push($_SESSION['flash'], "El cine se ha creado correctamente.");
				Functions::getInstance()->redirect("Cine","ShowListView");
			}
			else
			{
				array_push($_SESSION['flash'], "Ya existe un cine con ese nombre.");
				Functions::getInstance()->redirect("Cine","ShowAddView");
			}
		}
	}
?>