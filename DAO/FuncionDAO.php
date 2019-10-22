<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:06:02
	 */
	namespace DAO;

	use Models\Funcion as Funcion;
	use Models\Genero as Genero;
	use Models\Pelicula as Pelicula;
	use DAO\PeliculaDAO as PeliculaDAO;

	class FuncionDAO
	{
		private $funcionList = array();

		/**
		 * 
		 * @param funcion
		 */
		public function add(Funcion $funcion)
		{
			$this->retrieveData();

			array_push($this->funcionList, $funcion);
				
			$this->saveData();
		}

		function remove($id)
        {
            $this->RetrieveData();

            $this->funcionList = array_filter($this->funcionList, function($funcion) use($id){
                return $funcion->getId() != $id;
            });

            $this->SaveData();
		}
		
		public function removeByCine($nombreCine)
		{
			$this->RetrieveData();

            $this->funcionList = array_filter($this->funcionList, function($funcion) use($nombreCine){
                return $funcion->getNombreCine() != $nombreCine;
            });

			$this->SaveData();
		}

		public function getAll()
		{
			$this->Retrievedata();

			return $this->funcionList;
		}

		public function SaveData()
		{
			$arrayToEncode = array();

			foreach($this->funcionList as $funcion)
			{
				$valuesArray["id"] = $funcion->getId();
				$valuesArray["nombreCine"]= $funcion->getNombreCine();
				$valuesArray["fecha"]= $funcion->getFecha();
				$valuesArray["hora"]=$funcion->getHora();
				$valuesArray["idPelicula"]=$funcion->getIdPelicula();
				$valuesArray["cantEntradas"]=$funcion->getCantEntradas();
				$valuesArray["cantVendidas"]=$funcion->getCantVendidas();
			
				array_push($arrayToEncode, $valuesArray);
			}

			$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

			$jsonPath = $this->GetJsonFilePath(); //Get correct json path

			file_put_contents($jsonPath, $jsonContent);
		}

		public function RetrieveData()
		{
			$this->funcionList = array();

			$jsonPath = $this->GetJsonFilePath(); //Get correct json path

			if(file_exists($jsonPath));
			{
				$jsonContent = file_get_contents($jsonPath);

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$funcion = new Funcion();
					$funcion->setId($valuesArray["id"]);
					$funcion->setNombreCine($valuesArray["nombreCine"]);
					$funcion->setFecha($valuesArray["fecha"]);
					$funcion->setHora($valuesArray["hora"]);
					$funcion->setIdPelicula($valuesArray["idPelicula"]);
					$funcion->setCantEntradas($valuesArray["cantEntradas"]);
					$funcion->setCantVendidas($valuesArray["cantVendidas"]);

					array_push($this->funcionList, $funcion);
				}
			}
		}

		public function getById($id)
        {
            $funcion = null;

            $this->RetrieveData();

            $funciones = array_filter($this->funcionList, function($funcion) use($id){
                return $funcion->getId() == $id;
            });

            $funciones = array_values($funciones); //Reordering array indexes

            return (count($funciones) > 0) ? $funciones[0] : null;
        }

		public function getByCine($nombreCine)
        {
            $funcion = null;

            $this->RetrieveData();

            $funciones = array_filter($this->funcionList, function($funcion) use($nombreCine){
                return $funcion->getNombreCine() == $nombreCine;
            });

            $funciones = array_values($funciones); //Reordering array indexes

            return (count($funciones) > 0) ? $funciones : null;
		}
		
		//Need this function to return correct file json path
		function GetJsonFilePath(){

			$initialPath = "Data\\funciones.json";
			
			if(file_exists($initialPath)){
				$jsonFilePath = $initialPath;
			}else{
				$jsonFilePath = ROOT.$initialPath;
			}
			
			return $jsonFilePath;
		}
	}
?>