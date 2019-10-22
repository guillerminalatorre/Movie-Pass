<?php
/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:06:02
 */
namespace DAO;

use Models\Entrada as Entrada;

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

	function remove($nombre)
	{
		$this->RetrieveData();

		$this->entradaList = array_filter($this->entradaList, function($entrada) use($qr){
			return $entrada->getQr() != $qr;
		});

		$this->SaveData();
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
			$valuesArray["qr"]= $entrada->getQr();
			$valuesArray["id_compra"]= $entrada->getCompra();
			$valuesArray["id_funcion"]=$entrada->getFuncion();
		
			array_push($arrayToEncode, $valuesArray);
		}

		$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

		$jsonPath = $this->GetJsonFilePath(); //Get correct json path

		file_put_contents($jsonPath, $jsonContent);
	}

	public function retrieveData()
	{
		$this->entradaList = array();

		$jsonPath = $this->GetJsonFilePath(); //Get correct json path

		if(file_exists($jsonPath));
		{
			$jsonContent = file_get_contents($jsonPath);

			$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
			
			foreach($arrayToDecode as $valuesArray)
			{
				$entrada = new Entrada();
				$entrada->setQr($valuesArray["qr"]);
				$entrada->setCompra($valuesArray["id_compra"]);
				$entrada->setFuncion($valuesArray["id_funcion"]);

				array_push($this->entradaList, $entrada);
			}
		}
	}

	//Need this function to return correct file json path
	function GetJsonFilePath(){

		$initialPath = "Data\\entradas.json";
		
		if(file_exists($initialPath)){
			$jsonFilePath = $initialPath;
		}else{
			$jsonFilePath = ROOT.$initialPath;
		}
		
		return $jsonFilePath;
	}
}
?>