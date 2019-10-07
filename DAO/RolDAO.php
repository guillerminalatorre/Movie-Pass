<?php
require "Config/Autoload.php";
use Models\Rol as Rol;

namespace DAO;


/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:06:02
 */
class RolDAO
{

	private $rolList = array();

	/**
	 * 
	 * @param rol
	 */
	public function add(Rol $rol)
	{
		$this->retrieveData();

		array_push($this->rolList, $rol);
			
		$this->saveData();
	}

	public function getAll()
	{
		$this->Retrievedata();

		return $this->rolList;
	}

	public function SaveData()
	{
		$arrayToEncode = array();

		foreach($this->rolList as $rol)
		{
			$valuesArray["id"] = $rol->getId();
			$valuesArray["nombre"]= $rol->getNombre();
			$valuesArray["descripcion"]= $rol->getDescripcion();

		
			array_push($arrayToEncode, $valuesArray);
		}

		$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

		file_put_contents("Data/roles.json", $jsonContent);
	}

	public function RetrieveData()
	{
		$this->rolList = array();

		if(file_exists("Data/roles.json"));
		{
			$jsonContent = file_get_contents("Data/roles.json");

			$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
			
			foreach($arrayToDecode as $valuesArray)
			{
				$rol = new Rol();
				$rol->setId($valuesArray["id"]);
				$rol->setNombre($valuesArray["nombre"]);
				$rol->setDescripcion($valuesArray["descripcion"]);

				array_push($this->rolList, $rol);
			}
		}
	}

	/**
	 * 
	 * @param rol debe tener id o nombre.
	 */
	public function rolExists(Rol $rolAbuscar)
	{

		$this->rolList = array();

		if(file_exists("Data/roles.json"));
		{
			$jsonContent = file_get_contents("Data/roles.json");

			$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
			
			foreach($arrayToDecode as $valuesArray)
			{
				$rol = new Rol();
				$rol->setId($valuesArray["id"]);
				$rol->setNombre($valuesArray["nombre"]);
				$rol->setDescripcion($valuesArray["descripcion"]);

				if($rolAbuscar->getId() === $rol->getId())
				{
					return $rol->getId();
				}
				if($rolAbuscar->getNombre() === $rol->getNombre())
				{
					return $rol->getId();
				}
			}
		}

		return 0;

	}

	/**
	 * 
	 * @param id
	 */
	public function eliminarRol(int $id)
	{
		$this->rolList = array();

		if(file_exists("Data/roles.json"));
		{
			$jsonContent = file_get_contents("Data/roles.json");

			$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
			
			foreach($arrayToDecode as $valuesArray)
			{
				$rol = new Rol();
				$rol->setId($valuesArray["id"]);
				$rol->setNombre($valuesArray["nombre"]);
				$rol->setDescripcion($valuesArray["descripcion"]);

				if($id != $rol->getId())
				{
					array_push($this->rolList, $rol);
				}
			}

			$this->SaveData();
		}
	}

}
?>