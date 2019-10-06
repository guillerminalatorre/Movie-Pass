<?php


namespace DAO;


/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:06:02
 */
class CineDAO
{

	private $cineList = array();

	function __construct()
	{
	}

	function __destruct()
	{
	}



	/**
	 * 
	 * @param cine
	 */
	public function add(Cine $cine)
	{

		//codigo


				$this->retrieveData();
	
		        array_push($this->cineList, $cine);
		            
		        $this->saveData();
	}

	public function getAll()
	{

		//codigo


			$this->Retrievedata();
	
		    return $this->cellphoneList;
	}

	public function saveData()
	{
	}

	public function retrieveData()
	{
	}

	/**
	 * 
	 * @param cineAbuscar
	 */
	public function cineExiste(Cine $cineAbuscar)
	{

		//retorna 0 si no existe, la id si existe


	}

	/**
	 * 
	 * @param id
	 */
	public function eliminarCine(int $id)
	{
	}

}
?>