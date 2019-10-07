<?php
require "Config/Autoload.php";

use Models\Entrada as Entrada;

namespace DAO;


/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:06:02
 */
class EntradaDAO
{

	private $entradaList = array();

	/**
	 * 
	 * @param entrada
	 */
	public function add(Entrada $entrada)
	{
		$this->retrieveData();

		array_push($this->entradaList, $entrada);
			
		$this->saveData();
	}

	public function getAll()
	{
		$this->Retrievedata();

		return $this->entradasList;
	}


	public function saveData()
	{
		$arrayToEncode = array();

		foreach($this->entradaList as $entrada)
		{
			$valuesArray["id"] = $entrada->getId();
			$valuesArray["qr"]= $entrada->getQr();
			$valuesArray["id_compra"]= $entrada->getCompra();
			$valuesArray["id_funcion"]=$entrada->getFuncion();
		
			array_push($arrayToEncode, $valuesArray);
		}

		$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

		file_put_contents("Data/entradas.json", $jsonContent);
	}

	public function retrieveData()
	{
		$this->entradaList = array();

		if(file_exists("Data/entradas.json"));
		{
			$jsonContent = file_get_contents("Data/entradas.json");

			$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
			
			foreach($arrayToDecode as $valuesArray)
			{
				$entrada = new Entrada();
				$entrada->setId($valuesArray["id"]);
				$entrada->setQr($valuesArray["qr"]);
				$entrada->setCompra($valuesArray["id_compra"]);
				$entrada->setFuncion($valuesArray["id_funcion"]);

				array_push($this->entradaList, $entrada);
			}
		}
	}

	/**
	 * retorna 0 si no existe, la id si existe
	 * @param entrada
	 */
	public function entradaExists(Entrada $entradaAbuscar)
	{

		$this->entradaList = array();

		if(file_exists("Data/entradas.json"));
		{
			$jsonContent = file_get_contents("Data/entradas.json");

			$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
			
			foreach($arrayToDecode as $valuesArray)
			{
				$entrada = new Entrada();
				$entrada->setId($valuesArray["id"]);
				$entrada->setQr($valuesArray["qr"]);
				$entrada->setCompra($valuesArray["id_compra"]);
				$entrada->setFuncion($valuesArray["id_funcion"]);

				if($entradaAbuscar->getId() === $entrada->getId())
				{
					return $entrada->getId();
				}
				if($entradaAbuscar->getId_Compra() === $entrada->getId_Compra())
				{
					return $entrada->getId();
				}
				if($entradaAbuscar->getQr() === $entrada->getQr())
				{
					return $entrada->getId();
				}

			}
		}
	}

	/**
	 * 
	 * @param id
	 */
	public function eliminarEntrada(int $id)
	{
		$this->entradaList = array();

		if(file_exists("Data/entradas.json"));
		{
			$jsonContent = file_get_contents("Data/entradas.json");

			$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
			
			foreach($arrayToDecode as $valuesArray)
			{
				$entrada = new Entrada();
				$entrada->setId($valuesArray["id"]);
				$entrada->setQr($valuesArray["qr"]);
				$entrada->setCompra($valuesArray["id_compra"]);
				$entrada->setFuncion($valuesArray["id_funcion"]);

				if($id != $entrada->getId())
				{
					array_push($this->entradaList, $entrada);
				}
			}

			$this->SaveData();
		}
	}

}
?>