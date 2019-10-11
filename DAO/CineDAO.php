<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:06:02
	 */
	namespace DAO;

	use Models\Cine as Cine;

	class CineDAO
	{
		private $cineList = array();

		/**
		 * 
		 * @param cine
		 */
		public function add(Cine $cine)
		{
			$this->retrieveData();

			array_push($this->cineList, $cine);
				
			$this->saveData();
		}

		public function getAll()
		{
			$this->Retrievedata();

			return $this->cineList;
		}

		public function saveData()
		{
			$arrayToEncode = array();

			foreach($this->cineList as $cine)
			{
				$valuesArray["id"] = $cine->getId();
				$valuesArray["nombre"]= $cine->getNombre();
				$valuesArray["direccion"]= $cine->getDireccion();
				$valuesArray["capacidad"]=$cine->getCapacidad();
				$valuesArray["precio"]=$cine->getPrecio();
			
				array_push($arrayToEncode, $valuesArray);
			}

			$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

			file_put_contents("../Data/cines.json", $jsonContent);
		}

		public function retrieveData()
		{
			$this->cineList = array();

			if(file_exists("../Data/cines.json"));
			{
				$jsonContent = file_get_contents("../Data/cines.json");

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$cine = new Cine();
					$cine->setId($valuesArray["id"]);
					$cine->setNombre($valuesArray["nombre"]);
					$cine->setDireccion($valuesArray["direccion"]);
					$cine->setCapacidad($valuesArray["capacidad"]);
					$cine->setPrecio($valuesArray["precio"]);

					array_push($this->cineList, $cine);
				}
			}
		}

		/**
		 * retorna 0 si no existe, la id si existe
		 * @param cineAbuscar debe tener al menos el parametro "id" o el "nombre"
		 */
		public function cineExiste(Cine $cineAbuscar)
		{
			$this->cineList = array();

			if(file_exists("Data/cines.json"));
			{
				$jsonContent = file_get_contents("Data/cines.json");

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$cine = new Cine();
					$cine->setId($valuesArray["id"]);
					$cine->setNombre($valuesArray["nombre"]);
					$cine->setDireccion($valuesArray["direccion"]);
					$cine->setCapacidad($valuesArray["capacidad"]);
					$cine->setPrecio($valuesArray["precio"]);

					if($cineAbuscar->getId() === $cine->getId())
					{
						return $cine->getId();
					}
					if($cineAbuscar->getNombre() === $cine->getNombre())
					{
						return $cine->getId();
					}
				}
			}
			return 0;
		}

		/**
		 * 
		 * @param id
		 */
		public function eliminarCine(int $id)
		{
			$this->cineList = array();

			if(file_exists("Data/cines.json"));
			{
				$jsonContent = file_get_contents("Data/cines.json");

				$arrayToDencode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$cine = new Cine();
					$cine->setId($valuesArray["id"]);
					$cine->setNombre($valuesArray["nombre"]);
					$cine->setDireccion($valuesArray["direccion"]);
					$cine->setCapacidad($valuesArray["capacidad"]);
					$cine->setPrecio($valuesArray["precio"]);

					if($id != $cine->getId())
					{
						array_push($this->cineList, $cine);
					}
				}

				$this->SaveData();
			}
		}
	}
?>