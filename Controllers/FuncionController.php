<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:05:37
	 */
	namespace Controllers;

	use DAO\FuncionDAO as FuncionDAO;
	use DAO\CineDAO as CineDAO;
	use DAO\PeliculaDAO as PeliculaDAO;
	use Models\Funcion as Funcion;
	use Models\Cine as Cine;
	use Models\Pelicula as Pelicula;
	use Config\Functions as Functions;	

	class FuncionController
	{
		private $funcionDAO;
		private $cineDAO;
		private $peliculaDAO;

		function __construct()
		{
			$this->funcionDAO = new FuncionDAO();
			$this->cineDAO = new CineDAO();
			$this->peliculaDAO = new PeliculaDAO();
		}

		public function ShowAddView($idCine)
		{
			$peliculaList = $this->peliculaDAO->getAll();
			require_once(VIEWS_PATH."cine/funcion-add.php");
		}

		public function eliminarFuncion($id)
		{
			$_SESSION['flash'] = array();
			$funcion = new Funcion();
			$funcion->setId($id);
			$funcion = $this->funcionDAO->getFuncion($funcion);

			$idCine = $funcion->getIdCine();

			$this->funcionDAO->remove($funcion);

			array_push($_SESSION['flash'], "La funcion se ha eliminado correctamente.");
			Functions::getInstance()->redirect("Cine","ShowFichaView", $idCine);
		}

		public function Add($idCine, $idPelicula, $fecha,  $hora,  $cantEntradas)
		{
			$_SESSION['flash'] = array();

			if($this->checkAvailableTime($idCine,$idPelicula,$fecha,$hora))
			{
				$funcion = new Funcion();
				$funcion->setIdCine($idCine);
				$funcion->setIdPelicula($idPelicula);
				$funcion->setFecha($fecha);
				$funcion->setHora($hora);			
				$funcion->setCantEntradas($cantEntradas);

				$this->funcionDAO->add($funcion);
				array_push($_SESSION['flash'], "La funcion se ha agregado correctamente.");
				Functions::getInstance()->redirect("Cine","ShowFichaView", $idCine);
			}
			else
			{
				array_push($_SESSION['flash'], "El horario seleccionado no esta disponible.");
				Functions::getInstance()->redirect("Funcion","ShowAddView", $idCine);
			}
			
		}

		public function checkAvailableTime($idCine,$idPelicula,$fecha,$hora)
		{
			$available = true;

			// Obtengo datos del cine
			$cine = new Cine();
			$cine->setId($idCine);
			$cine = $this->cineDAO->getCine($cine);

			// Obtengo datos de la pelicula
			
			$pelicula = new Pelicula();
			$pelicula->setId($idPelicula);
			$pelicula = $this->peliculaDAO->getPelicula($pelicula);

			// Calculo inicio y fin estimados
			$inicio = strtotime("$fecha $hora");
			$duracion = $pelicula->getDuracion()+15;
			$string = "+".$duracion." minutes";
			$fin = strtotime($string,$inicio);

			$funcionList = $this->funcionDAO->getByCine($cine);

			foreach($funcionList as $funcion)
			{
				// Obtengo datos de la pelicula de cada funcion
				$peliculaFuncion = new Pelicula();
				$peliculaFuncion->setId($funcion->getIdPelicula());
				$peliculaFuncion = $this->peliculaDAO->getPelicula($peliculaFuncion);

				// Obtengo datos de la funcion
				$fechaFuncion = $funcion->getfecha();
				$horaFuncion = $funcion->getHora();
				$inicioFuncion = strtotime("$fechaFuncion $horaFuncion");
				$duracion = $peliculaFuncion->getDuracion()+15;
				$string = "+".$duracion." minutes";
				$finFuncion = strtotime($string,$timeFuncion);

				// Calculo si mis tiempos colisionan con otra funcion
				if($finFuncion > $inicio || $inicioFuncion < $fin) $available = false;
			}
			return $available;
		}
	}
?>