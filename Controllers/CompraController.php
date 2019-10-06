<?php


namespace Controllers;


/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:05:37
 */
class CompraController
{

	private $compraRepository;

	function __construct()
	{
	}

	function __destruct()
	{
	}



	/**
	 * 
	 * @param id
	 * @param fecha
	 * @param cantEntradas
	 * @param descuento
	 * @param total
	 * @param usuario
	 */
	public function _constructor(int $id, date $fecha, int $cantEntradas, int $descuento, float $total, Usuario $usuario)
	{
	}

	public function ShowAddView()
	{
	}

	public function ShowListView()
	{
	}

	public function Add()
	{
	}

}
?>