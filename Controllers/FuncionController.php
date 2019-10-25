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
			require_once(VIEWS_PATH."cine/funcion-add.php");
		}

		public function eliminarFuncion($id)
		{
			$_SESSION['flash'] = array();
			$funcion = new Funcion();
			$funcion->setId($id);
			$funcion = $this->funcionDAO->getFuncion($funcion);

			$nombreCine = $funcion->getIdCine();

			$this->funcionDAO->remove($id);

			array_push($_SESSION['flash'], "La funcion se ha eliminado correctamente.");
			Functions::getInstance()->redirect("Cine","ShowFichaView", $idCine);
		}

		public function Add($idCine, $idPelicula, $fecha,  $hora,  $cantEntradas)
		{
			$_SESSION['flash'] = array();
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

		public function showMovies(){
					
			$funciones=$this->funcionDAO->getAll();

			$peliculaList=array();
			foreach($funciones as $fun){
				$idPeli= $fun->getIdPelicula();
				$peli= new Pelicula();
				$peli-> setId($idPeli);

				$movieDetails= $this->peliculaDAO ->getPelicula($peli);

				array_push($peliculaList, $movieDetails);
			}
			require_once(VIEWS_PATH . "pelicula/searchbar.php");
			require_once(VIEWS_PATH . "pelicula/listarpeliculas.php");

		}
	}
?>