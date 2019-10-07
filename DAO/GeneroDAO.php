<?php
require "Config/Autoload.php";
use Models\Genero as Genero;

namespace DAO;


/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:06:02
 */
class GeneroDAO
{

	private $generoList = array ();

	/**
	 * 
	 * @param genero
	 */
	public function add(Genero $genero)
	{
		$this->retrieveData();

		array_push($this->generoList, $genero);
			
		$this->saveData();
	}

	public function getAll()
	{
		$this->Retrievedata();

		return $this->generoList;
	}

	public function SaveData()
	{
		$arrayToEncode = array();

		foreach($this->generoList as $genero)
		{
			$valuesArray["id"] = $genero->getId();
			$valuesArray["nombre"]= $genero->getNombre();
		
			array_push($arrayToEncode, $valuesArray);
		}

		$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

		file_put_contents("Data/generos.json", $jsonContent);
	}

	public function RetrieveData()
	{
		$this->generoList = array();

		if(file_exists("Data/generos.json"));
		{
			$jsonContent = file_get_contents("Data/generos.json");

			$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
			
			foreach($arrayToDecode as $valuesArray)
			{
				$genero = new Genero();
				$genero->setId($valuesArray["id"]);
				$genero->setNombre($valuesArray["nombre"]);

				array_push($this->generoList, $genero);
			}
		}
	}

	/**
	 * retorna 0 si no existe, la id si existe
	 * @param genero
	 */
	public function generoExists(Genero $generoAbuscar)
	{	
		$this->generoList = array();

		if(file_exists("Data/generos.json"));
		{
			$jsonContent = file_get_contents("Data/generos.json");

			$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
			
			foreach($arrayToDecode as $valuesArray)
			{
				$genero = new Genero();
				$genero->setId($valuesArray["id"]);
				$genero->setNombre($valuesArray["nombre"]);

				if($generoAbuscar->getId() === $genero->getId())
				{
					return $genero->getId();
				}
				if($generoAbuscar->getNombre() === $genero->getNombre())
				{
					return $genero->getId();
				}
			}
		}

	}

	/**
	 * 
	 * @param id
	 */
	public function eliminarGenero(int $id)
	{
		$this->generoList = array();

		if(file_exists("Data/generos.json"));
		{
			$jsonContent = file_get_contents("Data/generos.json");

			$arrayToDencode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
			
			foreach($arrayToDecode as $valuesArray)
			{
				$genero = new Genero();
				$genero->setId($valuesArray["id"]);
				$genero->setNombre($valuesArray["nombre"]);

				if($id != $genero->getId())
				{
					array_push($this->generoList, $genero);
				}
			}

			$this->SaveData();
		}
	}

}
?>