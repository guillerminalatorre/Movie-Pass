<?php

/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:05:37
 */

namespace Controllers;

use API\TMDBController as TMDBController;
use DAO\PeliculaDAO as PeliculaDAO;
use DAO\GeneroDAO as GeneroDAO;
use DAO\FuncionDAO as FuncionDAO;
use Models\Pelicula as Pelicula;
use Models\Genero as Genero;
use Models\Funcion as Funcion;

class PeliculaController extends Administrable
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
		if(!$this->loggedIn()) Functions::redirect("Home");
		if(!$this->isAdmin()) Functions::redirect("Home");

		$peliculaList = $this->peliculaDAO->getAll();
		require_once(VIEWS_PATH . "pelicula/pelicula-list.php");
	}

	public function ShowApiMovies()
	{
		if(!$this->loggedIn()) Functions::redirect("Home");
		if(!$this->isMainAdmin()) Functions::redirect("Home");

		$peliculaList = array();
		$page = 1;
		while(count($peliculaList) == 0)
		{
			$peliculaList= $this->getNowPlayingMoviesFromApi($page);
			$page++;
		}
		require_once(VIEWS_PATH."pelicula/pelicula-api.php");
	}

	public function SearchMovies($title)
	{
		if(!$this->loggedIn()) Functions::redirect("Home");
		if(!$this->isMainAdmin()) Functions::redirect("Home");

		$peliculaList = array();
		$peliculaList = $this->callSearchMovie($title);
		require_once(VIEWS_PATH."pelicula/pelicula-api.php");
	}

	public function Update($idPelicula, $titulo, $duracion, $descripcion, $idioma, $clasificacion, $video, $popularidad)
	{
		if(!$this->loggedIn()) Functions::redirect("Home");
		if(!$this->isAdmin()) Functions::redirect("Home");

		$titulo = Functions::validateData($titulo);
		$descripcion = Functions::validateData($descripcion);
		$idioma = Functions::validateData($idioma);
		$video = Functions::validateData($video);

		$pelicula = new Pelicula();
		$pelicula->setId($idPelicula);
		$pelicula = $this->peliculaDAO->getPelicula($pelicula);

		if($pelicula == null)
		{
			Functions::flash("La pelicula no existe.","warning");
			Functions::redirect("Pelicula","ShowListView");
		}

		// Imagen
		try
		{
			if($_FILES["image"]["error"] > 0)
			{
				$message = "Error: " . $_FILES["image"]["error"] . "<br>";
			}
			else
			{
				$fileName = Functions::validateData($_FILES["image"]["name"]);
				$tempFileName = $_FILES["image"]["tmp_name"];
				$type = $_FILES["image"]["type"];
				
				$filePath = UPLOADS_PATH.basename($fileName);
				$fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
				$imageSize = getimagesize($tempFileName);

				if($imageSize !== false)
				{
					if (move_uploaded_file($tempFileName, $filePath))
					{
						$pelicula->setPoster(UPLOADS_PATH.$fileName);
						Functions::flash("Imagen subida correctamente.","success");
					}
					else
						Functions::flash("Ocurrió un error al intentar subir la imagen.","danger");
				}
				else
					Functions::flash("El archivo no corresponde a una imágen.","warning");
			}
		}
		catch(Exception $ex)
		{
			Functions::flash($ex->getMessage());
		}
		// Fin imagen

		$pelicula->setTitulo($titulo);
		if($duracion > 0) $pelicula->setDuracion($duracion);
		else Functions::flash("La duracion debe ser mayor a 0.","warning");
		$pelicula->setDescripcion($descripcion);
		$pelicula->setIdioma($idioma);
		$pelicula->setClasificacion($clasificacion);
		$pelicula->setVideo($video);
		$pelicula->setPopularidad($popularidad);

		if($this->peliculaDAO->edit($pelicula)) Functions::flash("Los datos se han guardado correctamente.","success");
		else Functions::flash("Hubo un error al guardar los datos.","danger");
		Functions::redirect("Pelicula","ShowListView");
	}

	private function getNowPlayingMoviesFromApi($page = NULL)
	{
		if(!$this->loggedIn()) Functions::redirect("Home");
		if(!$this->isAdmin()) Functions::redirect("Home");

		if($page == NULL) $page = 1;

		$peliculaList = array();

		$arrayReque = array("api_key" => API_KEY, "language" => LANGUAGE_ES, "page"=> $page);

		$get_data = TMDBController::callAPI('GET', API . '/movie/now_playing', $arrayReque);

		$arrayToDecode = json_decode($get_data, true);

		foreach ($arrayToDecode["results"] as $valuesArray) 
		{
			$pelicula = new Pelicula();
			$pelicula->setIdTMDB($valuesArray["id"]);
			if($this->peliculaDAO->getByIdTMDB($pelicula) == NULL)
			{
				if($valuesArray["poster_path"] != NULL)
				{
					$posterPath = "https://image.tmdb.org/t/p/w500".$valuesArray["poster_path"];
				}
				else 
				{
					$posterPath = FRONT_ROOT.IMG_PATH."noImage.jpg";
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
		if(!$this->loggedIn()) return false;
		if(!$this->isAdmin()) return false;

		$pelicula = new Pelicula();
		$pelicula->setIdTMDB($idTMDB);
		if($this->peliculaDAO->getByIdTMDB($pelicula) != NULL) return false;

		$movie = $this->getMovieDetailsFromApi($idTMDB);
		$flag = $this->peliculaDAO->add($movie);
		if($flag) Functions::flash("Se agrego la pelicula correctamente.","success");
		else Functions::flash("Hubo un error al agregar la pelicula.","danger");
		return $flag;
	}

	public function callSearchMovie($title)
	{
		$arrayReque = array("api_key" => API_KEY, "language" => LANGUAGE_ES, "query"=>$title);

		$peliculaList=array();

		$get_data = TMDBController::callAPI('GET', API . '/search/movie', $arrayReque);

		$arrayToDecode = json_decode($get_data, true);

		foreach ($arrayToDecode["results"] as $valuesArray) 
		{
			$pelicula = new Pelicula();
			$pelicula->setIdTMDB($valuesArray["id"]);
			if($this->peliculaDAO->getByIdTMDB($pelicula) == NULL)
			{
				if($valuesArray["poster_path"] != NULL)
				{
					$posterPath = "https://image.tmdb.org/t/p/w500".$valuesArray["poster_path"];
				}
				else 
				{
					$posterPath = FRONT_ROOT.IMG_PATH."noImage.jpg";
				}
				$pelicula->setPoster($posterPath);			
				$pelicula->setTitulo($valuesArray["title"]);
				$pelicula->setPopularidad($valuesArray["vote_average"]);
				if(isset($valuesArray["release_date"]) && ($valuesArray["release_date"]!=NULL)){
					$pelicula->setFechaDeEstreno($valuesArray["release_date"]);
				}else{
					$pelicula ->setFechaDeEstreno("0000-00-00");
				};

				array_push($peliculaList, $pelicula);				
			}
		}
		return $peliculaList;
	}

	private function getMovieDetailsFromApi($idTMDB)
	{
		$arrayReque = array("api_key" => API_KEY, "language" => LANGUAGE_ES);

		$get_data = TMDBController::callAPI('GET', API . '/movie'. '/' . $idTMDB, $arrayReque);

		$arrayToDecode = json_decode($get_data, true);

		$pelicula = new Pelicula();
		$pelicula->setIdTMDB($arrayToDecode["id"]);
		if($arrayToDecode["poster_path"] != NULL)
		{
			$posterPath = "https://image.tmdb.org/t/p/w500".$arrayToDecode["poster_path"];
		}
		else 
		{
			$posterPath = FRONT_ROOT.IMG_PATH."noImage.jpg";
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

		$get_data = TMDBController::callAPI('GET', API . '/movie'. '/' . $idTMDB . "/videos", $arrayReque);

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
