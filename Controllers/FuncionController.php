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
	use DAO\GeneroDAO as GeneroDAO;
	use Models\Funcion as Funcion;
	use Models\Cine as Cine;
	use Models\Pelicula as Pelicula;
	use Config\Functions as Functions;	

	class FuncionController
	{
		private $funcionDAO;
		private $cineDAO;
		private $peliculaDAO;
		private $generoDAO;

		function __construct()
		{
			$this->funcionDAO = new FuncionDAO();
			$this->cineDAO = new CineDAO();
			$this->peliculaDAO = new PeliculaDAO();
			$this->generoDAO = new GeneroDAO();
		}

		public function ShowAddView($idCine)
		{
			$peliculaList = $this->peliculaDAO->getAll();
			require_once(VIEWS_PATH."funcion/funcion-add.php");
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

		public function Add($idCine, $idPelicula, $fecha, $hora)
		{
			$_SESSION['flash'] = array();

			$fechaHora = $fecha." ". $hora;

			if($idPelicula)
			{
				if($this->checkAvailableTime($idCine,$idPelicula,$fechaHora))
				{
					$funcion = new Funcion();
					$funcion->setIdCine($idCine);
					$funcion->setIdPelicula($idPelicula);
					$funcion->setFechaHora($fechaHora);

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
			else
			{
				array_push($_SESSION['flash'], "Debes seleccionar una pelicula.");
				Functions::getInstance()->redirect("Funcion","ShowAddView", $idCine);
			}			
		}

		private function checkAvailableTime($idCine,$idPelicula,$fechaHora)
		{
			$available = true;

			// Obtengo datos de la pelicula			
			$pelicula = new Pelicula();
			$pelicula->setId($idPelicula);
			$pelicula = $this->peliculaDAO->getPelicula($pelicula);

			// Calculo inicio y fin estimados
			$inicio = strtotime($fechaHora);
			$duracion = $pelicula->getDuracion()+15;
			$string = "+".$duracion." minutes";
			$fin = strtotime($string,$inicio);

			$cine = new Cine();
			$cine->setId($idCine);
			$funcionList = $this->funcionDAO->getByCine($cine);

			foreach($funcionList as $funcion)
			{
				// Obtengo datos de la pelicula de cada funcion
				$peliculaFuncion = new Pelicula();
				$peliculaFuncion->setId($funcion->getIdPelicula());
				$peliculaFuncion = $this->peliculaDAO->getPelicula($peliculaFuncion);

				// Obtengo datos de la funcion
				$fechaHora = $funcion->getFechaHora();
				$inicioFuncion = strtotime($fechaHora);
				$duracion = $peliculaFuncion->getDuracion()+15;
				$string = "+".$duracion." minutes";
				$finFuncion = strtotime($string,$inicioFuncion);

				// Calculo si mis tiempos colisionan con otra funcion
				if(($finFuncion > $inicio && $inicioFuncion < $inicio) || ($inicioFuncion < $fin && $finFuncion > $inicio)) $available = false;
			}
			return $available;
		}

		public function ShowMovies()
		{					
			$funciones = $this->funcionDAO->getDistinctPeliculas();
			$generoList = $this->generoDAO->getAll();
			$peliculaList = array();
			foreach($funciones as $funcion)
			{
				$pelicula = $this->peliculaDAO->getById($funcion->getIdPelicula());				
				array_push($peliculaList, $pelicula);			
			}
			require_once(VIEWS_PATH . "pelicula/searchbar.php");
			require_once(VIEWS_PATH . "pelicula/listarpeliculas.php");
		}

		public function FilterFunctions($idGenero, $chosenDate = null)
		{
			$generoList = $this->generoDAO->getAll();
			$funciones =$this->funcionDAO->getAll();
			$pelicula = new Pelicula();
			$peliculaList = array();
	
			if($idGenero != "none" && $chosenDate != null)
			{
				foreach($funciones as $funcion)
				{
					if($chosenDate==$funcion->getFecha())
					{
						$idPelicula = $funcion->getIdPelicula();
						$generos = $this->peliculaDAO->getGeneros($pelicula->setId($idPelicula));
						if(in_array($idGenero, $generos))
						{	
							$pelicula=$this->peliculaDAO->getById($idPelicula);
							if(!in_array($pelicula, $peliculaList))
							{
								array_push($peliculaList, $pelicula);
							}
						}
					}
				}
			} 
			else
			{
				if( $idGenero != "none")
				{
					foreach($funciones as $funcion)
					{
					$idPelicula = $funcion->getIdPelicula();
					$generos = $this->peliculaDAO->getGeneros($pelicula->setId($idPelicula));

						if(in_array($idGenero, $generos))
						{
							$pelicula=$this->peliculaDAO->getById($idPelicula);
							if(!in_array($pelicula, $peliculaList))
							{
								array_push($peliculaList, $pelicula);
							}
						}
					}
				} 
				else
				{	
					if( $chosenDate != null)
					{
						foreach($funciones as $funcion)
						{
							if($chosenDate==$funcion->getFecha())
								{
								$pelicula=$this->peliculaDAO->getById($funcion->getIdPelicula());
								if(!in_array($pelicula, $peliculaList)){
									array_push($peliculaList, $pelicula);
								}
							}
						}
					}
				}
			}
			
			require_once(VIEWS_PATH . "pelicula/searchbar.php");
			require_once(VIEWS_PATH . "pelicula/listarpeliculas.php");
		}

		public function ShowFuncionesPelicula($idPelicula = null)
		{
			$funciones = array();
			$cineList = array();
			if($idPelicula != NULL)
			{
				$pelicula = new Pelicula();
				$pelicula->setId($idPelicula);
				$pelicula = $this->peliculaDAO->getPelicula($pelicula);
				$funciones = $this->funcionDAO->getByPelicula($pelicula->getId());
				$cineList = $this->funcionDAO->getDistinctCineByPelicula($pelicula->getId());
			}
			else
			{
				$funciones = $this->funcionDAO->getDistinctPeliculas();
				$cineList = $this->funcionDAO->getDistinctCines();
			}
			require_once(VIEWS_PATH."funcion/funcion-pelicula-list.php");
		}
	}
