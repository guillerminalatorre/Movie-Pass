<?php
	namespace Controllers;

	use Models\Funcion as Funcion;
	use Models\Cine as Cine;
	use Models\Sala as Sala;
	use Models\Pelicula as Pelicula;
	use Models\Genero as Genero;
	use Models\Entrada as Entrada;
	use DAO\FuncionDAO as FuncionDAO;
	use DAO\CineDAO as CineDAO;
	use DAO\SalaDAO as SalaDAO;
	use DAO\PeliculaDAO as PeliculaDAO;
	use DAO\GeneroDAO as GeneroDAO;
	use DAO\EntradaDAO as EntradaDAO;
	use DateTime;

class FuncionController extends Administrable
	{
		private $funcionDAO;
		private $cineDAO;
		private $salaDAO;
		private $peliculaDAO;
		private $generoDAO;
		private $entradaDAO;

		function __construct()
		{
			$this->funcionDAO = new FuncionDAO();
			$this->cineDAO = new CineDAO();
			$this->salaDAO = new SalaDAO();
			$this->peliculaDAO = new PeliculaDAO();
			$this->generoDAO = new GeneroDAO();
			$this->entradaDAO = new EntradaDAO();
		}
			
		public function ShowAddView($idCine)
		{
			if (!$this->loggedIn()) Functions::redirect("Home");
			if (!$this->isAdmin()) Functions::redirect("Home");

			$cine = new Cine();
			$cine->setId($idCine);
			$salaList = $this->salaDAO->getByCine($cine);
			if(!isset($salaList) || count($salaList) == 0)
			{
				Functions::flash("El cine no tiene salas.","warning");
				Functions::redirect("Cine", "ShowFichaView", $idCine);
			}
			$peliculaList = $this->peliculaDAO->getAll();
			if(!isset($peliculaList) || count($peliculaList) == 0)
			{
				Functions::flash("No existen peliculas en la base de datos.","warning");
				Functions::redirect("Cine", "ShowFichaView", $idCine);
			}
			require_once(VIEWS_PATH . "funcion/funcion-add.php");
		}

		public function Remove($id)
		{
			if (!$this->loggedIn()) Functions::redirect("Home");
			if (!$this->isAdmin()) Functions::redirect("Home");

			$funcion = new Funcion();
			$funcion->setId($id);
			$funcion = $this->funcionDAO->getFuncion($funcion);

			$idCine = $funcion->getIdCine();

			if($this->funcionDAO->remove($funcion) != null) Functions::flash("La funcion se ha eliminado correctamente.","success");
			else Functions::flash("Hubo un error al eliminar la funcion.", "danger");			
			Functions::redirect("Cine", "ShowFichaView", $idCine);
		}

		public function Add($idCine, $idSala, $idPelicula, $fecha, $hora)
		{
			if (!$this->loggedIn()) Functions::redirect("Home");
			if (!$this->isAdmin()) Functions::redirect("Home");

			$fechaHora = $fecha." ".$hora;
			$hour = strtotime("H:i", $hora);
			$timePlus1Hour = strtotime('+1 hour');

			if (empty($idPelicula)) 
			{
				Functions::flash("Debes seleccionar una pelicula.","warning");
				Functions::redirect("Funcion", "ShowAddView", $idCine);
			}

			if($fecha == date("Y-m-d") && $hour < $timePlus1Hour)
			{
				Functions::flash("No se puede crear una funcion antes de la hora actual.","warning");
				Functions::redirect("Funcion", "ShowAddView", $idCine);
			}

			if (!$this->checkAvailableTime($idCine, $idSala, $idPelicula, $fechaHora)) 
			{
				Functions::flash("Existe una funcion en ese rango horario.","warning");
				Functions::redirect("Funcion", "ShowAddView", $idCine);
			}

			if (!$this->checkAvailablePelicula($idCine, $idSala, $idPelicula, $fechaHora)) 
			{
				Functions::flash("La pelicula ya tiene una funcion en otro cine/sala ese dia.","warning");
				Functions::redirect("Funcion", "ShowAddView", $idCine);
			}

			$funcion = new Funcion();
			$funcion->setIdCine($idCine);
			$funcion->setIdSala($idSala);
			$funcion->setIdPelicula($idPelicula);
			$funcion->setFechaHora($fechaHora);

			if($this->funcionDAO->add($funcion) != null) Functions::flash("La funcion se ha agregado correctamente.","success");
			else Functions::flash("Hubo un error al agregar la funcion.","danger");
			Functions::redirect("Cine", "ShowFichaView", $idCine);
		}

		private function checkAvailableTime($idCine, $idSala, $idPelicula, $fechaHora)
		{
			$available = true;

			// Obtengo datos de la pelicula			
			$pelicula = new Pelicula();
			$pelicula->setId($idPelicula);
			$pelicula = $this->peliculaDAO->getPelicula($pelicula);

			// Calculo inicio y fin estimados
			$inicio = strtotime($fechaHora);
			$duracion = $pelicula->getDuracion() + 15;
			$string = "+" . $duracion . " minutes";
			$fin = strtotime($string, $inicio);

			$cine = new Cine();
			$cine->setId($idCine);
			$sala = new Sala();
			$sala->setId($idSala);
			$funcionList = $this->funcionDAO->getByCineSala($cine,$sala);

			foreach ($funcionList as $funcion) {
				// Obtengo datos de la pelicula de cada funcion
				$peliculaFuncion = new Pelicula();
				$peliculaFuncion->setId($funcion->getIdPelicula());
				$peliculaFuncion = $this->peliculaDAO->getPelicula($peliculaFuncion);

				// Obtengo datos de la funcion
				$inicioFuncion = strtotime($funcion->getFechaHora());
				$duracion = $peliculaFuncion->getDuracion() + 15;
				$string = "+" . $duracion . " minutes";
				$finFuncion = strtotime($string, $inicioFuncion);

				// Calculo si mis tiempos colisionan con otra funcion
				if (($finFuncion > $inicio && $inicioFuncion < $inicio) || ($inicioFuncion < $fin && $finFuncion > $inicio)) $available = false;
			}
			return $available;
		}

		private function checkAvailablePelicula($idCine, $idSala, $idPelicula, $fechaHora)
		{
			$available = true;
			$timestamp = strtotime($fechaHora);
			$fecha = date("Y-m-d", $timestamp);
			$funcionList = $this->funcionDAO->checkAvailablePelicula($idPelicula, $fecha);
			foreach ($funcionList as $funcion) 
			{
				if ($funcion->getIdCine() != $idCine) $available = false;
				if ($funcion->getIdSala() != $idSala) $available = false;
				if ($available == false) break;
			}
			return $available;
		}

		public function ShowMovies()
		{
			$funciones = $this->funcionDAO->getPeliculasDisponibles();
			$generoList = $this->generoDAO->getAll();
			$peliculaList = array();
			foreach ($funciones as $funcion) 
			{
				$pelicula = new Pelicula();
				$pelicula->setId($funcion->getIdPelicula());
				$pelicula = $this->peliculaDAO->getPelicula($pelicula);
				array_push($peliculaList, $pelicula);
			}
			require_once(VIEWS_PATH . "pelicula/searchbar.php");
			require_once(VIEWS_PATH . "pelicula/listarpeliculas.php");
		}

		public function FilterFunctions($genreId = null, $fechaInicio = null, $fechaFin = null)
		{
			$generoList = $this->generoDAO->getAll();
			$peliculaList = array();
			$genreId = ($genreId == "NULL") ? null : $genreId;
			$funciones = $this->funcionDAO->getMoviesByGenreAndDate($genreId, $fechaInicio, $fechaFin);

			if(!empty($funciones))
			{				
				foreach ($funciones as $funcion) 
				{
					$pelicula = new Pelicula();
					$idPelicula = $funcion->getIdPelicula();
					$pelicula->setId($idPelicula);
					$pelicula = $this->peliculaDAO->getPelicula($pelicula);
					array_push($peliculaList, $pelicula);
				}
			}

			require_once(VIEWS_PATH . "pelicula/searchbar.php");
			require_once(VIEWS_PATH . "pelicula/listarpeliculas.php");
		}

		public function ShowFuncionesPelicula($idPelicula = null)
		{
			$funciones = array();
			$cineList = array();
			$pelicula = new Pelicula();
			$cine = new Cine();
			$sala = new Sala();

			$esAdmin = $this->isAdmin();

			if ($idPelicula != NULL) 
			{
				$pelicula->setId($idPelicula);
				$pelicula = $this->peliculaDAO->getPelicula($pelicula);
				$funciones = $this->funcionDAO->getByPelicula($pelicula);
				$cineList = $this->funcionDAO->getDistinctCineByPelicula($pelicula->getId());
			}
			else 
			{
				$funciones = $this->funcionDAO->getDistinctPeliculas();
				$cineList = $this->funcionDAO->getDistinctCines();
			}
			require_once(VIEWS_PATH . "funcion/funcion-pelicula-list.php");
		}
	}
?>
