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

		private $connection;
        private $tableName = "Funciones";


		/**
		 * 
		 * @param funcion
		 */
		public function add($funcion)

		try
		{
			$query = "INSERT INTO ".$this->tableName." (id_funcion, id_cine, id_pelicula, fecha, hora, cantEntradas) VALUES (:id_funcion, :id_cine, :id_pelicula, :fecha, :hora, :cantEntradas);";
			
			$parameters["id_funcion"] = $usuario->getId();
			$parameters["id_cine"]= $usuario->getIdCine();
			$parameters["id_pelicula"]= $usuario->getIdPelicula();
			$parameters["fecha"]=$usuario->getFecha();
			$parameters["hora"]=$usuario->getHora();
			$parameters["cantEntradas"]=$usuario->getCantEntradas();
			$this->connection = Connection::GetInstance();
			$this->connection->ExecuteNonQuery($query, $parameters);
		}
		catch(Exception $ex)
		{
			throw $ex;
		}

		}

		

		function remove($funcion)
        {
			try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE id = ".$funcion->getId().";";
                
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
		}
		
		public function removeByCine($cine)
		{
			try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE id = ".$cine->getId().";";
                
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
		}

		public function getAll()
		{
			try
            {
                $list = array();
                $query = "SELECT * FROM ".$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {
					$funcion = new funcion();
					$funcion->setId($row["id_funcion"]);
					$funcion->setIdCine($row["id_cine"]);
					$funcion->setIdPelicula($row["id_pelicula"]);
					$funcion->setFecha($row["fecha"]);
					$funcion->setHora($row["hora"]);
					$funcion->setCantEntradas($row["cant_entradas"]);
                    array_push($list, $funcion);
				}
				
                return $list;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
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