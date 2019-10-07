<?php
require "Config/Autoload.php";
use DAO\FuncionDAO as FuncionDAO;
use Models\Funcion as Funcion;

namespace Controllers;


/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:05:37
 */
class FuncionController
{

	private $funcionDAO;


	 function __construct()
	 {
		 $this->funcionDAO = new FuncionDAO();
	 }
 
	 public function ShowAddView()
	 {
		 require_once(VIEWS_PATH. "");
	 }
 
	 public function ShowListView()
	 {
		 $funcionList = $this->funcionDAO->getAll();
 
		 require_once(VIEWS-PATH."");
	 }

	public function Add(int $id, int $id_Cine, string $fecha, string $hora, int $id_Pelicula, int $cantEntradas, int $cantVendidas)
	{
		$funcion = new Funcion($id, $id_Cine, $fecha, $hora, $id_Pelicula, $cantEntradas, $cantVendidas);

		$this->funcionDAO->add($funcion);

		$this->ShowAddView();
	}

}
?>