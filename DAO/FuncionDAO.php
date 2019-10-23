<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:06:02
	 */
	namespace DAO;

	use Models\Funcion as Funcion;
	use Models\Cine as Cine;
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
		{
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
                $query = "DELETE FROM ".$this->tableName." WHERE id_cine = ".$cine->getId().";";
                
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
					$funcion = new Funcion();
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

		public function getFuncion($funcion)
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE id = ".$funcion->getId().";";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {
					$funcion->setId($row["id_funcion"]);
					$funcion->setIdCine($row["id_cine"]);
					$funcion->setIdPelicula($row["id_pelicula"]);
					$funcion->setFecha($row["fecha"]);
					$funcion->setHora($row["hora"]);
					$funcion->setCantEntradas($row["cant_entradas"]);
                    return $funcion;
				}
				return null;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

		public function getByCine($idCine)
        {
            try
            {
                $list = array();
                $query = "SELECT * FROM ".$this->tableName" WHERE id_cine = ".$idCine.";";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {
					$funcion = new Funcion();
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

		public function edit($funcion)
		{
			try
            {
				$query = "UPDATE ".$this->tableName." SET id_funcion = :id_funcion, id_cine = :id_cine, id_pelicula = :id_pelicula, fecha = :fecha, hora = :hora, cantEntradas = :cantEntradas WHERE id_usuario =".$funcion->getId().";";

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
	}
?>