<?php


namespace DAO;


/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:06:02
 */
class RolDAO
{

	private $rolList = array();

	function __construct()
	{
	}

	function __destruct()
	{
	}



	/**
	 * 
	 * @param rol
	 */
	public function add(Rol $rol)
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
	 * @param rol
	 */
	public function rolExists(Rol $rol)
	{

		//retorna 0 si no existe, la id si existe


	}

	/**
	 * 
	 * @param id
	 */
	public function eliminarRol(int $id)
	{
	}

}
?>