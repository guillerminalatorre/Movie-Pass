<?php
	namespace Controllers;

	use DAO\CineDAO as CineDAO;
	use DAO\SalaDAO as SalaDAO;
	use DAO\FuncionDAO as FuncionDAO;
	use DAO\PeliculaDAO as PeliculaDAO;
	use DAO\EntradaDAO as EntradaDAO;
	use Models\Cine as Cine;
	use Models\Funcion as Funcion;
	use Models\Pelicula as Pelicula;
	use Models\Entrada as Entrada;
	
	class CineController extends Administrable
	{
		private $cineDAO;
		private $salaDAO;
		private $funcionDAO;
		private $peliculaDAO;
		private $entradaDAO;

		public function __construct()
		{
			$this->cineDAO = new CineDAO();
			$this->salaDAO = new SalaDAO();
			$this->funcionDAO = new FuncionDAO();
			$this->peliculaDAO = new PeliculaDAO();
			$this->entradaDAO = new EntradaDAO();
		}

		public function ShowListView()
		{
			if(!$this->loggedIn()) Functions::redirect("Home");
			if(!$this->isAdmin()) Functions::redirect("Home");

			$cineList = $this->cineDAO->getAll();
			require_once(VIEWS_PATH."cine/cine-list.php");
		}

		public function ShowAddView()
		{
			if(!$this->loggedIn()) Functions::redirect("Home");
			if(!$this->isAdmin()) Functions::redirect("Home");

			require_once(VIEWS_PATH."cine/add-cine.php");
		}

		public function ShowFichaView($id)
		{
			if(!$this->loggedIn()) Functions::redirect("Home");
			if(!$this->isAdmin()) Functions::redirect("Home");

			$cine = new Cine();
			$cine->setId($id);
			$cine = $this->cineDAO->getCine($cine);
			$pelicula = new Pelicula();
			$salaList = $this->salaDAO->getByCine($cine);
			$funcionList = $this->funcionDAO->getByCine($cine);
			require_once(VIEWS_PATH."cine/cine-ficha.php");
		}

		public function ShowEditView($id)
		{
			if(!$this->loggedIn()) Functions::redirect("Home");
			if(!$this->isAdmin()) Functions::redirect("Home");

			$cine = new Cine();
			$cine->setId($id);
			$cine = $this->cineDAO->getCine($cine);
			require_once(VIEWS_PATH."cine/cine-edit.php");
		}

		public function updateCine($nombre, $direccion, $capacidad, $precio)
		{
			if(!$this->loggedIn()) Functions::redirect("Home");
			if(!$this->isAdmin()) Functions::redirect("Home");

			$_SESSION['flash'] = array();

			$nombre = Functions::validateData($nombre);
			$direccion = Functions::validateData($direccion);
			$capacidad = Functions::validateData($capacidad);
			$precio = Functions::validateData($precio);

			$cine = $this->cineDAO->getByNombre($nombre);
			if($cine == null)
			{
				array_push($_SESSION['flash'], "El cine no existe.");
				Functions::redirect("Cine","ShowListView");
			}

			$cine->setNombre($nombre);
			$cine->setDireccion($direccion);
			$cine->setCapacidad($capacidad);
			$cine->setPrecio($precio);
			$this->cineDAO->edit($cine);
			array_push($_SESSION['flash'], "Los datos se han guardado correctamente.");
			Functions::redirect("Cine","ShowFichaView", $cine->getId());
		}

		public function Remove($id)
		{
			if(!$this->loggedIn()) Functions::redirect("Home");
			if(!$this->isAdmin()) Functions::redirect("Home");

			$_SESSION['flash'] = array();
			$cine = new Cine();
			$cine->setId($id);
			$this->cineDAO->remove($cine);

			array_push($_SESSION['flash'], "El cine se ha eliminado correctamente.");
			Functions::redirect("Cine","ShowListView");
		}

		public function Add($nombre, $direccion, $capacidad, $precio)
		{
			if(!$this->loggedIn()) Functions::redirect("Home");
			if(!$this->isAdmin()) Functions::redirect("Home");

			$_SESSION['flash'] = array();
			
			$nombre = Functions::validateData($nombre);
			$direccion = Functions::validateData($direccion);
			$capacidad = Functions::validateData($capacidad);
			$precio = Functions::validateData($precio);

			if($this->cineDAO->getByNombre($nombre))
			{
				array_push($_SESSION['flash'], "Ya existe un cine con ese nombre.");
				Functions::redirect("Cine","ShowAddView");
			}

			$cine = new Cine();
			$cine->setNombre($nombre);
			$cine->setDireccion($direccion);
			$cine->setCapacidad($capacidad);
			$cine->setPrecio($precio);
			$this->cineDAO->add($cine);
			array_push($_SESSION['flash'], "El cine se ha creado correctamente.");
			Functions::redirect("Cine","ShowListView");
		}
	}
?>