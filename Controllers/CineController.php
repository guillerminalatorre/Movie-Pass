<?php
	namespace Controllers;

	use DAO\CineDAO as CineDAO;
	use DAO\SalaDAO as SalaDAO;
	use DAO\FuncionDAO as FuncionDAO;
	use DAO\PeliculaDAO as PeliculaDAO;
	use DAO\EntradaDAO as EntradaDAO;
	use Models\Cine as Cine;
	use Models\Sala as Sala;
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
			if($cine == null)
			{
				Functions::flash("El cine no existe.","warning");
				Functions::redirect("Cine","ShowListView");
			}
			$sala = new Sala();
			
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
			if($cine == null)
			{
				Functions::flash("El cine no existe.","warning");
				Functions::redirect("Cine","ShowListView");
			}

			require_once(VIEWS_PATH."cine/cine-edit.php");
		}

		public function Update($id, $nombre, $direccion)
		{
			if(!$this->loggedIn()) Functions::redirect("Home");
			if(!$this->isAdmin()) Functions::redirect("Home");

			$id = Functions::validateData($id);
			$nombre = Functions::validateData($nombre);
			$direccion = Functions::validateData($direccion);

			$cine = new Cine();
			$cine->setId($id);
			$cine = $this->cineDAO->getCine($cine);
			if($cine == null)
			{
				Functions::flash("El cine no existe.","warning");
				Functions::redirect("Cine","ShowListView");
			}

			$cine->setNombre($nombre);
			$cine->setDireccion($direccion);
			
			if($this->cineDAO->edit($cine)) Functions::flash("Los datos se han guardado correctamente.","success");
			else Functions::flash("Hubo un error al guardar los datos.","danger");
			
			Functions::redirect("Cine","ShowFichaView", $cine->getId());
		}

		public function Remove($id)
		{
			if(!$this->loggedIn()) Functions::redirect("Home");
			if(!$this->isAdmin()) Functions::redirect("Home");

			$id = Functions::validateData($id);

			$cine = new Cine();
			$cine->setId($id);

			if($this->cineDAO->remove($cine)) Functions::flash("El cine se ha eliminado correctamente.","success");
			else Functions::flash("Hubo un error al eliminar el cine.");

			Functions::redirect("Cine","ShowListView");
		}

		public function Add($nombre, $direccion)
		{
			if(!$this->loggedIn()) Functions::redirect("Home");
			if(!$this->isAdmin()) Functions::redirect("Home");
			
			$nombre = Functions::validateData($nombre);
			$direccion = Functions::validateData($direccion);

			$cine = new Cine();
			$cine->setNombre($nombre);
			if($this->cineDAO->getByNombre($cine) != null)
			{
				Functions::flash("Ya existe un cine con ese nombre.","warning");
				Functions::redirect("Cine","ShowAddView");
			}
			
			$cine->setDireccion($direccion);

			if($this->cineDAO->add($cine)) Functions::flash("El cine se ha creado correctamente.","success");
			else Functions::flash("Hubo un error al crear el cine.","danger");

			Functions::redirect("Cine","ShowListView");
		}
	}
?>