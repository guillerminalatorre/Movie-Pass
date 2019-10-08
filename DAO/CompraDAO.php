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
				$valuesArray["cantEntradas"]= $compra->getCantEntradas();
				$valuesArray["descuento"]=$compra->getDescuento();
				$valuesArray["total"]=$compra->getTotal();
				$valuesArray["id_Usuario"]=$compra->getId_Usuario();
			
				array_push($arrayToEncode, $valuesArray);
			}

			$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

			file_put_contents("Data/compras.json", $jsonContent);
		}

		public function retrieveData()
		{
			$this->compraList = array();

			if(file_exists("Data/compras.json"));
			{
				$jsonContent = file_get_contents("Data/compras.json");

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$compra = new Compra();
					$compra->setId($valuesArray["id"]  );
					$compra->setFecha($valuesArray["fecha"] );
					$compra->setCantEntradas($valuesArray["cantEntradas"] );
					$compra->setDescuento($valuesArray["descuento"]);
					$compra->setTotal($valuesArray["total"]);
					$compra->setId_Usuario($valuesArray["id_Usuario"]);

					array_push($this->compraList, $compra);
				}
			}
		}

		/**
		 * retorna 0 si no existe, la id si existe
		 * @param compraAbuscar debe tener al menos el parametro "id" o el "id_Usuario"
		 */
		public function compraExists(Compra $compraAbuscar)
		{
			$this->compraList = array();

			if(file_exists("Data/compras.json"));
			{
				$jsonContent = file_get_contents("Data/compras.json");

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$compra = new Compra();
					$compra->setId($valuesArray["id"]  );
					$compra->setFecha($valuesArray["fecha"] );
					$compra->setCantEntradas($valuesArray["cantEntradas"] );
					$compra->setDescuento($valuesArray["descuento"]);
					$compra->setTotal($valuesArray["total"]);
					$compra->setId_Usuario($valuesArray["id_Usuario"]);

					if($compraAbuscar->getId() === $compra->getId())
					{
						return $compra->getId();
					}
					if($compraAbuscar->getId_Usuario() === $compra->getId_Usuario())
					{
						return $compra->getId();
					}
				}
			}

			return 0;
		}

		/**
		 * 
		 * @param id
		 */
		public function eliminarCompra(int $id)
		{
			$this->compraList = array();

			if(file_exists("Data/compras.json"));
			{
				$jsonContent = file_get_contents("Data/compras.json");

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$compra = new Compra();
					$compra->setId($valuesArray["id"]  );
					$compra->setFecha($valuesArray["fecha"] );
					$compra->setCantEntradas($valuesArray["cantEntradas"] );
					$compra->setDescuento($valuesArray["descuento"]);
					$compra->setTotal($valuesArray["total"]);
					$compra->setId_Usuario($valuesArray["id_Usuario"]);

					if($id != $compra->getId())
					{
						array_push($this->compraList, $compra);
					}
				}

				$this->SaveData();
			}
		}
	}
?>