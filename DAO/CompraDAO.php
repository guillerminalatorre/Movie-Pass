<?php
/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:06:02
 */
namespace DAO;

use Models\Compra as Compra;

class CompraDAO
{
	private $compraList = array();

	/**
	 * 
	 * @param compra
	 */
	public function add(Compra $compra)
	{
		$this->retrieveData();

		array_push($this->compraList, $compra);
			
		$this->saveData();
	}

	function remove($nombre)
	{
		$this->RetrieveData();

		$this->compraList = array_filter($this->compraList, function($compra) use($id){
			return $compra->getId() != $id;
		});

		$this->SaveData();
	}

	public function getAll()
	{
		$this->Retrievedata();

		return $this->compraList;
	}

	public function saveData()
	{
		$arrayToEncode = array();

		foreach($this->compraList as $compra)
		{
			$valuesArray["id"] = $compra->getId();
			$valuesArray["fecha"]= $compra->getFecha();
			$valuesArray["descuento"]=$compra->getDescuento();
			$valuesArray["total"]=$compra->getTotal();
			$valuesArray["id_Usuario"]=$compra->getId_Usuario();
		
			array_push($arrayToEncode, $valuesArray);
		}

		$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

		$jsonPath = $this->GetJsonFilePath(); //Get correct json path

		file_put_contents($jsonPath, $jsonContent);
	}

	public function retrieveData()
	{
		$this->compraList = array();

		$jsonPath = $this->GetJsonFilePath(); //Get correct json path

		if(file_exists($jsonPath));
		{
			$jsonContent = file_get_contents($jsonPath);

			$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
			
			foreach($arrayToDecode as $valuesArray)
			{
				$compra = new Compra();
				$compra->setId($valuesArray["id"]  );
				$compra->setFecha($valuesArray["fecha"] );
				$compra->setDescuento($valuesArray["descuento"]);
				$compra->setTotal($valuesArray["total"]);
				$compra->setId_Usuario($valuesArray["id_Usuario"]);

				array_push($this->compraList, $compra);
			}
		}
	}

	//Need this function to return correct file json path
	function GetJsonFilePath(){

		$initialPath = "Data\compras.json";
		
		if(file_exists($initialPath)){
			$jsonFilePath = $initialPath;
		}else{
			$jsonFilePath = ROOT.$initialPath;
		}
		
		return $jsonFilePath;
	}
}
?>