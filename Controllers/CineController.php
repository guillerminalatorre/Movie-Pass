<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:05:37
	 */
	namespace Controllers;

	use DAO\CineDAO as CineDAO;
	use DAO\FuncionDAO as FuncionDAO;
	use DAO\PeliculaDAO as PeliculaDAO;
	use Models\Cine as Cine;
	use Models\Funcion as Funcion;
	use Models\Pelicula as Pelicula;
	use Config\Functions as Functions;
	
	class CineController
	{
		private $cineDAO;
		private $funcionDAO;
		private $peliculaDAO;

		public function __construct()
		{
			$this->cineDAO = new CineDAO();
			$this->funcionDAO = new FuncionDAO();
			$this->peliculaDAO = new PeliculaDAO();
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

		public function ShowFichaView($id)
		{
			$cine = new Cine();
			$cine->setId($id);
			$cine = $this->cineDAO->getCine($cine);
			$funcionList = $this->funcionDAO->getByCine($id);
			require_once(VIEWS_PATH."cine/cine-ficha.php");
		}

		public function ShowEditView($id)
		{
			$cine = new Cine();
			$cine->setId($id);
			$cine = $this->cineDAO->getCine($cine);
			require_once(VIEWS_PATH."cine/cine-edit.php");
		}

		public function updateCine($nombre, $direccion, $capacidad, $precio)
		{
			$_SESSION['flash'] = array();

			$nombre = Functions::getInstance()->escapar($nombre);
			$direccion = Functions::getInstance()->escapar($direccion);
			$capacidad = Functions::getInstance()->escapar($capacidad);
			$precio = Functions::getInstance()->escapar($precio);

			$cine = $this->cineDAO->getByNombre($nombre);

			if($cine != null)
			{
				$cine->setNombre($nombre);
				$cine->setDireccion($direccion);
				$cine->setCapacidad($capacidad);
				$cine->setPrecio($precio);
				$this->cineDAO->edit($cine);
				array_push($_SESSION['flash'], "Los datos se han actualizado correctamente.");
			}
			else
			{
				array_push($_SESSION['flash'], "El cine no existe.");
				Functions::getInstance()->redirect("Cine","ShowListView");
			}

			Functions::getInstance()->redirect("Cine","ShowFichaView", $cine->getId());
		}

		public function eliminarCine($id)
		{
			$_SESSION['flash'] = array();
			$cine = new Cine();
			$cine->setId($id);
			$this->cineDAO->remove($cine);

			array_push($_SESSION['flash'], "El cine se ha eliminado correctamente.");
			Functions::getInstance()->redirect("Cine","ShowListView");
		}

		public function Add($nombre, $direccion, $capacidad, $precio)
		{
			$_SESSION['flash'] = array();
			
			$nombre = Functions::getInstance()->escapar($nombre);
			$direccion = Functions::getInstance()->escapar($direccion);
			$capacidad = Functions::getInstance()->escapar($capacidad);
			$precio = Functions::getInstance()->escapar($precio);

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