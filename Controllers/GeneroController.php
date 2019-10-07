<?php
require "Config/Autoload.php";
use DAO\GeneroDAO as GeneroDAO;
use Models\Genero as Genero;

namespace Controllers;


/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:05:37
 */
class GeneroController
{

	private $generosDAO;

	function __construct()
	{
		$this->generosDAO = new GeneroDAO();
	}

	public function ShowAddView()
	{
		require_once(VIEWS_PATH. "");
	}

	public function ShowListView()
	{
		$generoList = $this->generosDAO->getAll();

		require_once(VIEWS-PATH."");
	}

	public function Add(int $id, string $nombre)
	{
		$genero = new Genero($id, $nombre);

		$this->generosDAO->add($genero);

		$this->ShowAddView();
	}

}
?>