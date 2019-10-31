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

	public function showApiMovies()
	{
		$peliculaList = array();
		$page = 1;
		while(count($peliculaList) == 0)
		{
			$peliculaList= $this->getNowPlayingMoviesFromApi($page);
			$page++;
		}
		require_once(VIEWS_PATH . "pelicula/peliculas-api.php");
	}


	public function updatePelicula($idPelicula, $titulo, $duracion, $descripcion, $idioma, $clasificacion, $video, $popularidad)
	{
		$_SESSION['flash'] = array();
		$titulo = Functions::getInstance()->escapar($titulo);
		$descripcion = Functions::getInstance()->escapar($descripcion);
		$idioma = Functions::getInstance()->escapar($idioma);
		$video = Functions::getInstance()->escapar($video);

		$pelicula = new Pelicula();
		$pelicula->setId($idPelicula);
		$pelicula = $this->peliculaDAO->getPelicula($pelicula);

		if($pelicula != null)
		{
			// Imagen
			try
			{
				if($_FILES["image"]["error"] > 0)
				{
					$message = "Error: " . $_FILES["image"]["error"] . "<br>";
				}
				else
				{
					$fileName = Functions::getInstance()->escapar($_FILES["image"]["name"]);
					$tempFileName = $_FILES["image"]["tmp_name"];
					$type = $_FILES["image"]["type"];
					
					$filePath = UPLOADS_PATH.basename($fileName);
					$fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
					$imageSize = getimagesize($tempFileName);

					if($imageSize !== false)
					{
						if (move_uploaded_file($tempFileName, $filePath))
						{
							$pelicula->setPoster(FRONT_ROOT.UPLOADS_PATH.$fileName);
							array_push($_SESSION['flash'], "Imagen subida correctamente.");
						}
						else
							array_push($_SESSION['flash'], "Ocurrió un error al intentar subir la imagen.");
					}
					else
						array_push($_SESSION['flash'], "El archivo no corresponde a una imágen.");
				}
			}
			catch(Exception $ex)
			{
				array_push($_SESSION['flash'], $ex->getMessage());
			}
			// Fin imagen

			$pelicula->setTitulo($titulo);
			if($duracion > 0) $pelicula->setDuracion($duracion);
			else array_push($_SESSION['flash'], "La duracion debe ser mayor a 0.");
			$pelicula->setDescripcion($descripcion);
			$pelicula->setIdioma($idioma);
			$pelicula->setClasificacion($clasificacion);
			$pelicula->setVideo($video);
			$pelicula->setPopularidad($popularidad);

			$this->peliculaDAO->edit($pelicula);
			array_push($_SESSION['flash'], "Los datos se han actualizado correctamente.");
		}
		else
		{
			array_push($_SESSION['flash'], "La pelicula no existe.");
		}
		
		Functions::getInstance()->redirect("Pelicula","ShowListView");
	}

	public function getNowPlayingMoviesFromApi($page = NULL)
	{
		if($page == NULL) $page = 1;

		$peliculaList = array();

		$arrayReque = array("api_key" => API_KEY, "language" => LANGUAGE_ES, "page"=> $page);

		$get_data = APIController::callAPI('GET', API . '/movie/now_playing', $arrayReque);

		$arrayToDecode = json_decode($get_data, true);

		foreach ($arrayToDecode["results"] as $valuesArray) 
		{
			if($this->peliculaDAO->getByIdTMDB($valuesArray["id"]) == NULL)
			{			
				$pelicula = new Pelicula();

				$pelicula->setIdTMDB($valuesArray["id"]);
				if($valuesArray["poster_path"] != NULL)
				{
					$posterPath = "https://image.tmdb.org/t/p/w500".$valuesArray["poster_path"];
				}
				else 
				{
					$posterPath = IMG_PATH."noImage.jpg";
				}
				$pelicula->setPoster($posterPath);
		
				$generos = array();
				
				$pelicula->setTitulo($valuesArray["title"]);
				$pelicula->setPopularidad($valuesArray["vote_average"]);
				$pelicula->setFechaDeEstreno($valuesArray["release_date"]);

				array_push($peliculaList, $pelicula);				
			}
		}
		return $peliculaList;
	}

	public function AddToDatabase($idTMDB)
	{
		if($this->peliculaDAO->getByIdTMDB($idTMDB) == NULL)
		{
			$movie = $this->getMovieDetailsFromApi($idTMDB);
			$this->peliculaDAO->add($movie);
			return true;
		}
		return false;
	}

	private function getMovieDetailsFromApi($idTMDB)
	{
		$arrayReque = array("api_key" => API_KEY, "language" => LANGUAGE_ES);

		$get_data = APIController::callAPI('GET', API . '/movie'. '/' . $idTMDB, $arrayReque);

		$arrayToDecode = json_decode($get_data, true);

		$pelicula = new Pelicula();
		$pelicula->setIdTMDB($arrayToDecode["id"]);
		if($arrayToDecode["poster_path"] != NULL)
		{
			$posterPath = "https://image.tmdb.org/t/p/w500".$arrayToDecode["poster_path"];
		}
		else 
		{
			$posterPath = IMG_PATH."noImage.jpg";
		}
		$pelicula->setPoster($posterPath);
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
