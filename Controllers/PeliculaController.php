<?php
/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:05:37
 */
namespace Controllers;

use DAO\PeliculaDAO as PeliculaDAO;
use Models\Pelicula as Pelicula;

class PeliculaController
{
	private $peliculaDAO;

	function __construct()
	{
		$this->peliculaDAO = new PeliculaDAO();
	}

	public function getMovies()
	{
		$peliculaList = $this->peliculaDAO->getNowPlayingMovies();
		return $peliculaList;
	}

	public function getTotalPages()
	{
		$totalPages = $this->peliculaDAO->getNumberOfTotalPages();
		return $totalPages;
	}

	public function getFilteredMovies($id)
	{
		$peliculaList= $this->peliculaDAO->getMoviesByGender($id);
		return $peliculaList;
	}

	public function replaceGenreNames($peliculaList)
	{
		foreach($peliculaList as $pelicula)
		{
			$generoNames = array();
			$peliculaGeneros = $pelicula->getGeneros();
			$generoController = new GeneroController();
			foreach($peliculaGeneros as $generoId)
			{
				array_push($generoNames, $generoController->getNombrePorId($generoId));
			}
			$pelicula->setGeneros($generoNames);
		}
		return $peliculaList;
	}
}
?>
