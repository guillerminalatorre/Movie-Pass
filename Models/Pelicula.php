<?php
require_once ('Genero.php');

namespace Models;



use Models;
/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:07:11
 */
class Pelicula
{

	private $id;
	private $titulo;
	private $generos;
	private $duracion;
	private $descripcion;
	private $clasificacion;
	public $m_Genero;

	function __construct()
	{
	}

	function __destruct()
	{
	}



	public function agregarActor()
	{
	}

	public function agregarGenero()
	{
	}

}
?>