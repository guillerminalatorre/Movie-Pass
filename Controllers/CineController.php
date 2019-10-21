<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:05:37
	 */
	namespace Controllers;

	use DAO\CineDAO as CineDAO;
	use Models\Cine as Cine;
	use Config\Functions as Functions;	
	
	class CineController
	{
		private $cineDAO;

		public function __construct()
		{
			$this->cineDAO = new CineDAO();
		}

		public function getCineList()
		{
			$cineList = $this->cineDAO->getAll();
			return $cineList;
		}

		public function getCine($nombre)
		{
			$cine = $this->cineDAO->getByNombre($nombre);
			return $cine;
		}

		public function updateCine($nombre, $direccion, $capacidad, $precio)
		{
			$_SESSION['flash'] = array();
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

			Functions::getInstance()->redirect("Home","FichaCine",$nombre);
		}

		public function eliminarCine($nombre)
		{
			$_SESSION['flash'] = array();
			$this->cineDAO->remove($nombre);
			
			$funcionController = new FuncionController();
			$funcionController->eliminarPorCine($nombre);

			array_push($_SESSION['flash'], "El cine se ha eliminado correctamente.");
			Functions::getInstance()->redirect("Home","ListCines");
		}

		public function Add($nombre, $direccion, $capacidad, $precio)
		{
			$_SESSION['flash'] = array();
			if(!$this->cineDAO->getByNombre($nombre))
			{
				$cine = new Cine();

				$cine->setNombre($nombre);
				$cine->setDireccion($direccion);
				$cine->setCapacidad($capacidad);
				$cine->setPrecio($precio);

				$this->cineDAO->add($cine);

				array_push($_SESSION['flash'], "El cine se ha creado correctamente.");
				Functions::getInstance()->redirect("Home","ListCines");
			}
			else
			{
				array_push($_SESSION['flash'], "Ya existe un cine con ese nombre.");
				Functions::getInstance()->redirect("Home","AddCine");
			}
		}
	}
?>