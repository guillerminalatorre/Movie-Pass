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
			$cine = $this->cineDAO->getByNombre($nombre);

			if($cine != null)
			{
				// $cine->setNombre($nombre);
				$cine->setDireccion($direccion);
				$cine->setCapacidad($capacidad);
				$cine->setPrecio($precio);
				$this->cineDAO->saveData();
			}

			Functions::getInstance()->redirect("Home","FichaCine",$nombre);
		}

		public function eliminarCine($nombre)
		{
			$this->cineDAO->remove($nombre);
			
			$funcionController = new FuncionController();
			$funcionController->eliminarPorCine($nombre);

			Functions::getInstance()->redirect("Home","ListCines");
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

				Functions::getInstance()->redirect("Home","ListCines");
			}
			else
			{
				Functions::getInstance()->redirect("Home","AddCine");
			}
		}
	}
?>