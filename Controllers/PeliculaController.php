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
use DAO\FuncionDAO as FuncionDAO;
use Models\Pelicula as Pelicula;
use Models\Genero as Genero;
use Models\Funcion as Funcion;
use Config\Functions as Functions;

class PeliculaController
{
	private $peliculaDAO;
	private $generoDAO;
	private $funcionDAO;

	function __construct()
	{
		$this->peliculaDAO = new PeliculaDAO();
		$this->generoDAO = new GeneroDAO();
		$this->funcionDAO = new FuncionDAO();
	}

	public function ShowListView()
	{
		$peliculaList = $this->peliculaDAO->getAll();
		require_once(VIEWS_PATH . "pelicula/pelicula-list.php");
	}

	public function ShowSearchBar()
	{
		$generoList = $this->generoDAO->getAll();
		require_once(VIEWS_PATH . "pelicula/searchbar.php");
	}

	public function ShowFilteredList($id = null, $fecha = null)
	{
		$peliculaList = $this->peliculaDAO->getAll();
		require_once(VIEWS_PATH . "pelicula/listarpeliculas.php");
	}

	public function getNowPlayingMoviesFromApi()
	{
		$arrayReque = array("api_key" => API_KEY, "language" => LANGUAGE_ES, "region" => "AR");

		$get_data = APIController::callAPI('GET', API . '/movie/now_playing', $arrayReque);

		$arrayToDecode = json_decode($get_data, true);

		foreach ($arrayToDecode["results"] as $valuesArray) 
		{
			if($this->peliculaDAO->getByIdTMDB($valuesArray["id"]) == null)
			{
				$pelicula = new Pelicula();
				$pelicula = $this->getMovieDetailsFromApi($valuesArray["id"]);
				$this->peliculaDAO->add($pelicula);
			}
		}

		Functions::getInstance()->redirect("System");
	}

	public function getMovieDetailsFromApi($idTMDB)
	{
		$arrayReque = array("api_key" => API_KEY, "language" => LANGUAGE_ES);

		$get_data = APIController::callAPI('GET', API . '/movie'. '/' . $idTMDB, $arrayReque);

		$arrayToDecode = json_decode($get_data, true);

		$pelicula = new Pelicula();
		$pelicula->setIdTMDB($arrayToDecode["id"]);
		$pelicula->setPoster($arrayToDecode["poster_path"]);
		$pelicula->setIdioma($arrayToDecode["original_language"]);

		$generos = array();
		foreach($arrayToDecode["genres"] as $genero)
		{
			array_push($generos,$genero["id"]);
		}
		$pelicula->setGeneros($generos);

		$arrayToDecode["adult"] != false ? $adult = $arrayToDecode["adult"] : $adult = 0;
		$pelicula->setClasificacion($adult);
		$pelicula->setTitulo($arrayToDecode["title"]);
		$pelicula->setPopularidad($arrayToDecode["vote_average"]);
		$pelicula->setDescripcion($arrayToDecode["overview"]);
		$pelicula->setFechaDeEstreno($arrayToDecode["release_date"]);
		$pelicula->setDuracion($arrayToDecode["runtime"]);

		$arrayReque = array("api_key" => API_KEY, "language" => LANGUAGE_ES);

		$get_data = APIController::callAPI('GET', API . '/movie'. '/' . $idTMDB . "/videos", $arrayReque);

		$arrayToDecode = json_decode($get_data, true);

		foreach($arrayToDecode["results"] as $valuesArray)
		{
			if(!strcmp($valuesArray["site"], "YouTube"))
			{
				$pelicula->setVideo($valuesArray["key"]);
			}
		}
		return $pelicula;
	}
}
?>