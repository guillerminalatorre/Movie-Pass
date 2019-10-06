<?php


namespace DAO;


/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:06:02
 */
class PeliculaDAO
{

	private $peliculaList = array;

	function __construct()
	{
	}

	function __destruct()
	{
	}



	/**
	 * 
	 * @param pelicula
	 */
	public function add(Pelicula $pelicula)
	{
		$this->RetrieveData();
	
		array_push($this->peliculaList, $pelicula);
	
		$this->SaveData();
	}

	public function getAll()
	{
		$this->Retrievedata();
	
		return $this->peliculaList;
	}

	public function SaveData()
	{
	}

	public function RetrieveData()
	{
	}

	/**
	 * retorna 0 si no existe, la id si existe
	 * 
	 * @param cine
	 */
	public function peliculaExists(Cine $cine)
	{

		//retorna 0 si no existe, la id si existe


	}

	/**
	 * 
	 * @param id
	 */
	public function eliminarPelicula(int $id)
	{
	}

}
?>