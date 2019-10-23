<?php

/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:05:37
 */

namespace Controllers;

use API\APIController as APIController;
use DAO\PeliculaDAO as PeliculaDAO;
use DAO\GeneroDAO as GeneroDAO;
use Models\Pelicula as Pelicula;

class PeliculaController
{
	private $peliculaDAO;

	function __construct()
	{
		$this->peliculaDAO = new PeliculaDAO();
		$this->generoDAO = new GeneroDAO();
	}

	public function ShowListView()
	{
		$this->ShowSearchBar();
		$peliculaList = $this->peliculaDAO->getNowPlayingMovies();
		$totalPages = $this->peliculaDAO->getTotalPages();
		require_once(VIEWS_PATH . "pelicula/listarpeliculas.php");
	}

	public function ShowSearchBar()
	{
		$generoList = $this->generoDAO->getAll();
		require_once(VIEWS_PATH . "pelicula/searchbar.php");
	}

	public function ShowFilteredList($id = null, $fecha = null)
	{
		$peliculaList = $this->peliculaDAO->getFilteredMovies($id, $fecha);
		$totalPages = $this->peliculaDAO->getTotalPages();
		require_once(VIEWS_PATH . "pelicula/listarpeliculas.php");
	}

	public function getNowPlayingMovies()
	{
		if (isset($_GET['page'])) {
			$pageValue = $_GET['page'];
		} else {
			$pageValue = 1;
		}

		$arrayReque = array("api_key" => API_KEY, "language" => LANGUAGE_ES, "region" => "AR", "page" => $pageValue);

		$get_data = APIController::callAPI('GET', API . '/movie/now_playing', $arrayReque);

		$arrayToDecode = json_decode($get_data, true);

		foreach ($arrayToDecode["results"] as $valuesArray) {
			$pelicula = new Pelicula();
			$pelicula->setIdTMDB($valuesArray["id"]);
			$pelicula->setPoster($valuesArray["poster_path"]);
			$pelicula->setIdioma($valuesArray["original_language"]);
			$pelicula->setClasificacion($valuesArray["adult"]);
			//$pelicula->agregarGenero($genero);
			$pelicula->setTitulo($valuesArray["title"]);
			$pelicula->setPopularidad($valuesArray["vote_average"]);
			$pelicula->setDescripcion($valuesArray["overview"]);
			$pelicula->setFechaDeEstreno($valuesArray["release_date"]);

			if ($valuesArray["video"] != false) {
				$pelicula->setVideo($valuesArray["video"]);
			}

			$this->peliculaDAO->add($pelicula);
		}

		//TODO: CHECKEAR SI SE SIGUE NECESITANDO..
		$this->totalPages = $arrayToDecode["total_pages"];
		
	}

	public function getMovieDetailsFromApi($idTMDB){
		$arrayReque = array("api_key" => API_KEY, "language" => LANGUAGE_ES, "append_to_response"=>"videos");

		$get_data = APIController::callAPI('GET', API . '/movie'. '/' . $idTMDB, $arrayReque);

		$arrayToDecode = json_decode($get_data, true);

		$pelicula = new Pelicula();
			$pelicula->setIdTMDB($arrayToDecode["id"]);
			$pelicula->setPoster($arrayToDecode["poster_path"]);
			$pelicula->setIdioma($arrayToDecode["original_language"]);
			$pelicula->setClasificacion($arrayToDecode["adult"]);
			$pelicula->setTitulo($arrayToDecode["title"]);
			$pelicula->setPopularidad($arrayToDecode["vote_average"]);
			$pelicula->setDescripcion($arrayToDecode["overview"]);
			$pelicula->setFechaDeEstreno($arrayToDecode["release_date"]);
			$pelicula->setClasificacion($arrayToDecode["adult"]);
			$pelicula->setPoster($arrayToDecode["runtime"]);

			if ($arrayToDecode["video"] != false) {
				$pelicula->setVideo($arrayToDecode["video"]);
			}
	
		return $pelicula;
	}
}

?>