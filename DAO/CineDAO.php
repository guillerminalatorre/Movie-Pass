<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:06:02
	 */
	namespace DAO;
    use DAO\Connection as Connection;
	use Models\Cine as Cine;

	class CineDAO
	{
		private $connection;
		private $tableName = "Cines";		
		
		/**
		 * 
		 * @param cine
		 */
		public function add($cine)
		{
			try
			{
				$query = "INSERT INTO ".$this->tableName." (nombre, direccion, capacidad, precio) VALUES (:nombre, :direccion, :capacidad, :precio);";
				
				$parameters["nombre"]=$cine->getNombre();
				$parameters["direccion"]=$cine->getDireccion();
				$parameters["capacidad"]=$cine->getCapacidad();
				$parameters["precio"]=$cine->getPrecio();

				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters);
			}
			catch(Exception $ex)
			{
				throw $ex;
			}
		}

		function remove($cine)
		{
			try
			{
				$query = "DELETE FROM ".$this->tableName." WHERE id_cine = :id_cine;";

				$parameters["id_cine"]=$cine->getId();
				
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
					$cine = new Cine();
					$cine->setId($row["id_cine"]);
					$cine->setNombre($row["nombre"]);
					$cine->setDireccion($row["direccion"]);
					$cine->setCapacidad($row["capacidad"]);
					$cine->setPrecio($row["precio"]);

					array_push($list, $cine);
				}
				
				return $list;
			}
			catch(Exception $ex)
			{
				throw $ex;
			}
		}

		public function getCine($cine)
		{
			try
			{
				$query = "SELECT * FROM ".$this->tableName." WHERE id_cine = ".$cine->getId().";";
				$this->connection = Connection::GetInstance();
				$resultSet = $this->connection->Execute($query);
				
				foreach ($resultSet as $row)
				{
					$cine->setId($row["id_cine"]);
					$cine->setNombre($row["nombre"]);
					$cine->setDireccion($row["direccion"]);
					$cine->setCapacidad($row["capacidad"]);
					$cine->setPrecio($row["precio"]);

					return $cine;
				}
				return null;
			}
			catch(Exception $ex)
			{
				return null;
			}
		}

		public function getByNombre($nombre)
		{
			try
			{
				$query = "SELECT * FROM ".$this->tableName." WHERE nombre = '".$nombre."';";
				$this->connection = Connection::GetInstance();
				$resultSet = $this->connection->Execute($query);
				
				foreach ($resultSet as $row)
				{
					$cine = new Cine();
					$cine->setId($row["id_cine"]);
					$cine->setNombre($row["nombre"]);
					$cine->setDireccion($row["direccion"]);
					$cine->setCapacidad($row["capacidad"]);
					$cine->setPrecio($row["precio"]);
					return $cine;
				}
				return null;
			}
			catch(Exception $ex)
			{
				return null;
			}
		}

		public function getByFunciones($funcionList)
		{
			try
			{
				$cines = array();
				foreach ($funcionList as $funcion) {
				
					$query = "SELECT * FROM ".$this->tableName." WHERE id_cine = '".$funcion->getIdCine()."';";
					$this->connection = Connection::GetInstance();
					$resultSet = $this->connection->Execute($query);
					
					foreach ($resultSet as $row)
					{
						$cine = new Cine();
						$cine->setId($row["id_cine"]);
						$cine->setNombre($row["nombre"]);
						$cine->setDireccion($row["direccion"]);
						$cine->setCapacidad($row["capacidad"]);
						$cine->setPrecio($row["precio"]);

						array_push($cines, $cine);
					}
					return $cines;
				}
			}
			catch(Exception $ex)
			{
				return null;
			}
		}

		public function edit($cine)
		{
			try
			{
				$query = "UPDATE ".$this->tableName." SET id_cine = :id_cine, nombre = :nombre, direccion = :direccion, capacidad = :capacidad, precio = :precio WHERE id_cine =".$cine->getId().";";

				$parameters["id_cine"] = $cine->getId();
				$parameters["nombre"]= $cine->getNombre();
				$parameters["direccion"]= $cine->getDireccion();
				$parameters["capacidad"]=$cine->getCapacidad();
				$parameters["precio"]=$cine->getPrecio();
				$parameters["id_cine"] = $cine->getId();

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