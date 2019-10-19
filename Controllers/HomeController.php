<?php

/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:05:37
 */

namespace Controllers;

use Models\Usuario as Usuario;

class HomeController
{
	public function Index($message = "")
	{
		$this->ListMovies();		
	}

	// Vistas de usuario
	public function Login()
	{
		require_once(VIEWS_PATH."usuario/login.php");
	}

	public function Register()
	{
		require_once(VIEWS_PATH."usuario/register.php");
	}

	public function ViewProfile($email)
	{
		$usuarioController = new UsuarioController();
		$usuario = $usuarioController->getUser($email);
		require_once(VIEWS_PATH."usuario/profile.php");
	}

	public function EditProfile($email)
	{
		$usuarioController = new UsuarioController();
		$usuario = $usuarioController->getUser($email);
		require_once(VIEWS_PATH."usuario/profile-edit.php");
	}

	public function ListUsers()
	{
		$usuarioController = new UsuarioController();
		$usuarioList = $usuarioController->getUserList();
		require_once(VIEWS_PATH."usuario/usuario-list.php");
	}

	// Vistas de pelicula
	public function ListMovies()
	{
		$generoController = new GeneroController();		
		$generoList = $generoController->getGeneroList();
		require_once(VIEWS_PATH."pelicula/searchbar.php");
		$peliculaController = new PeliculaController();
		$peliculaList = $peliculaController->getMovies();
		$totalPages = $peliculaController->getTotalPages();
		$peliculaList = $peliculaController->replaceGenreNames($peliculaList);
		require_once(VIEWS_PATH."pelicula/listarpeliculas.php");
	}

	public function SearchMovies()
	{
		$generoController = new GeneroController();
		$generoList = $generoController->getGeneroList();
		require_once(VIEWS_PATH."pelicula/searchbar.php");
	}

	public function FilteredMovies($id)
	{
		$peliculaController = new PeliculaController();
		$peliculaList = $peliculaController->getFilteredMovies($id);	
		$totalPages = $peliculaController->getTotalPages();
		$peliculaList = $peliculaController->replaceGenreNames($peliculaList);
		require_once(VIEWS_PATH."pelicula/listarpeliculas.php");
	}

	// Vistas de cine
	public function ListCines()
	{
		$cineController = new CineController();
		$cineList = $cineController->getCineList();
		require_once(VIEWS_PATH."cine/cine-list.php");
	}

	public function AddCine()
	{
		require_once(VIEWS_PATH."cine/add-cine.php");
	}

	public function FichaCine($nombre)
	{
		$cineController = new CineController();
		$cine = $cineController->getCine($nombre);
		$funcionController = new FuncionController();		
		$funcionList = $funcionController->getFuncionesDeCine($nombre);
		require_once(VIEWS_PATH."cine/cine-ficha.php");
	}

	public function ModificarCine($nombre)
	{
		$cineController = new CineController();
		$cineList = $cineController->getCine($nombre);
		require_once(VIEWS_PATH."cine/cine-edit.php");
	}

	public function AddFuncion($nombre_Cine)
	{
		$funcionController = new FuncionController();
		$id = $funcionController->iDdisponible();
		require_once(VIEWS_PATH."cine/funcion-add.php");		
	}
}
