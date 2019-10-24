<?php

/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:05:37
 */

namespace Controllers;

use DAO\UsuarioDAO as UsuarioDAO;
use DAO\PeliculaDAO as PeliculaDAO;
use DAO\CineDAO as CineDAO;
use DAO\FuncionDAO as FuncionDAO;

class SystemController
{
	private $usuarioDAO;
	private $peliculaDAO;
	private $cineDAO;
	private $funcionDAO;

	function __construct()
	{
		$this->usuarioDAO = new UsuarioDAO();
		$this->peliculaDAO = new PeliculaDAO();
		$this->cineDAO = new CineDAO();
		$this->funcionDAO = new FuncionDAO();
	}

	public function Index()
	{
		$usuarioCount = count($this->usuarioDAO->getAll());
		$peliculaCount = count($this->peliculaDAO->getAll());
		$cineCount = count($this->cineDAO->getAll());
		$funcionCount = count($this->funcionDAO->getAll());
		require_once(VIEWS_PATH."system/system.php");
	}
}