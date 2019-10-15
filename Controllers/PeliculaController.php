<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:05:37
	 */
	namespace Controllers;

	use DAO\PeliculaDAO as PeliculaDAO;
	use DAO\GeneroDAO as GeneroDAO;
	use Models\Pelicula as Pelicula;

	class PeliculaController
	{
		private $peliculaDAO;
		private $generoDAO;

		function __construct()
		{
			$this->peliculaDAO = new PeliculaDAO();
			$this->generoDAO= new GeneroDAO();
		}

		public function ShowAddView()
		{
			require_once(VIEWS_PATH. "searchbar.php");
		}

		public function ShowMovies(){
			$generoList=$this->generoDAO->getAll();
			$peliculaList=$this->peliculaDAO->getNowPlayingMovies();
			$totalPages=$this->peliculaDAO->getNumberOfTotalPages();

			require_once(VIEWS_PATH."searchbar.php");

			foreach($peliculaList as $pelicula){
				$generoNames=array();
				$peliculaGeneros=$pelicula->getGeneros();
				foreach($peliculaGeneros as $generoId){
					array_push($generoNames, $this->generoDAO->GetGeneroForId($generoId));
				}
				$pelicula->setGeneros($generoNames);
			}
			require_once(VIEWS_PATH. "listarpeliculas.php");
		}

		public function ShowFilteredMovies($id)
		{
			$peliculaList= $this->peliculaDAO->getByGenre($id);
			$totalPages=$this->peliculaDAO->getNumberOfTotalPages();

			foreach($peliculaList as $pelicula){
				$generoNames=array();
				$peliculaGeneros=$pelicula->getGeneros();
				foreach($peliculaGeneros as $generoId){
					array_push($generoNames, $this->generoDAO->GetGeneroForId($generoId));
				}
				$pelicula->setGeneros($generoNames);
			}

			require_once(VIEWS_PATH."listarpeliculas.php");
		}
	}
