<?php


namespace DAO;


/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:06:02
 */
class EntradaDAO
{

	private $entradaList = array();

	function __construct()
	{
	}

	function __destruct()
	{
	}



	/**
	 * 
	 * @param entrada
	 */
	public function add(Entrada $entrada)
	{
	}

	public function getAll()
	{
	}

	public function SaveData()
	{
	}

	public function RetrieveData()
	{
	}

	/**
	 * 
	 * @param entrada
	 */
	public function entradaExists(Entrada $entrada)
	{

		//retorna 0 si no existe, la id si existe


	}

	/**
	 * 
	 * @param id
	 */
	public function eliminarEntrada(int $id)
	{
	}

}
?>