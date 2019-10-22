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
		require_once(VIEWS_PATH."pelicula/listarpeliculas.php");
	}

	public function ShowSearchBar()
	{
		$generoList = $this->generoDAO->getAll();
		require_once(VIEWS_PATH."pelicula/searchbar.php");
	}

	public function ShowFilteredList($id = null, $fecha = null)
	{
		$peliculaList = $this->peliculaDAO->getFilteredMovies($id);	
		$totalPages = $this->peliculaDAO->getTotalPages();
		require_once(VIEWS_PATH."pelicula/listarpeliculas.php");
	}
}
?>
