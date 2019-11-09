<?php
	namespace DAO;

	use Models\Entrada as Entrada;
	use Models\Compra as Compra;
	use Models\Funcion as Funcion;

	class EntradaDAO
	{
		private $connection;
		private $tableName = "Entradas";

		public function add($entrada)
		{
			try
			{
				$query = "INSERT INTO ".$this->tableName." (id_compra, id_funcion, qr) VALUES (:id_compra, :id_funcion, :qr);";
				
				$parameters["id_compra"] = $entrada->getIdCompra();
				$parameters["id_funcion"] = $entrada->getIdFuncion();
				$parameters["qr"] =$entrada->getQr();

				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters);
				return true;
			}
			catch(Exception $ex)
			{
				return false;
			}
		}		

		function remove($entrada)
		{
			try
			{
				$query = "DELETE FROM ".$this->tableName." WHERE id_entrada = :id_entrada;";
				
				$parameters['id_entrada'] = $entrada->getId();
				
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters);
				return true;
			}
			catch(Exception $ex)
			{
				return false;
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
					$entrada = new Entrada();
					$entrada->setId($row["id_entrada"]);
					$entrada->setIdCompra($row["id_compra"]);
					$entrada->setIdFuncion($row["id_funcion"]);
					$entrada->setQr($row["qr"]);
					array_push($list, $entrada);
				}				
				return $list;
			}
			catch(Exception $ex)
			{
				return null;
			}
		}

		public function getEntrada($entrada)
		{
			try
			{
				$query = "SELECT * FROM ".$this->tableName." WHERE id_entrada = ".$entrada->getId().";";
				$this->connection = Connection::GetInstance();
				$resultSet = $this->connection->Execute($query);
				
				foreach ($resultSet as $row)
				{
					$entrada->setId($row["id_entrada"]);
					$entrada->setIdCompra($row["id_compra"]);
					$entrada->setIdFuncion($row["id_funcion"]);
					$entrada->setQr($row["qr"]);
					return $entrada;
				}
			}
			catch(Exception $ex)
			{
				return null;
			}
		}

		public function getByCompra($compra)
		{
			try
			{
				$list = array();
				$query = "SELECT * FROM ".$this->tableName." WHERE id_compra = ".$compra->getId().";";
				$this->connection = Connection::GetInstance();
				$resultSet = $this->connection->Execute($query);
				
				foreach ($resultSet as $row)
				{
					$entrada = new Entrada();
					$entrada->setId($row["id_entrada"]);
					$entrada->setIdCompra($row["id_compra"]);
					$entrada->setIdFuncion($row["id_funcion"]);
					$entrada->setQr($row["qr"]);
					array_push($list, $entrada);
				}				
				return $list;
			}
			catch(Exception $ex)
			{
				return null;
			}
		}
		
		public function getByFuncion($funcion)
		{
			try
			{
				$list = array();
				$query = "SELECT * FROM ".$this->tableName." WHERE id_funcion = ".$funcion->getId().";";
				$this->connection = Connection::GetInstance();
				$resultSet = $this->connection->Execute($query);
				
				foreach ($resultSet as $row)
				{
					$entrada = new Entrada();
					$entrada->setId($row["id_entrada"]);
					$entrada->setIdCompra($row["id_compra"]);
					$entrada->setIdFuncion($row["id_funcion"]);
					$entrada->setQr($row["qr"]);
					array_push($list, $entrada);
				}				
				return $list;
			}
			catch(Exception $ex)
			{
				return null;
			}
		}


		public function edit($entrada)
		{
			try
			{
				$query = "UPDATE ".$this->tableName." SET id_compra = :id_compra, id_funcion = :id_funcion, qr = :qr WHERE id_entrada = :id_entrada;";

				$parameters["id_compra"]= $entrada->getIdCompra();
				$parameters["id_funcion"]= $entrada->getIdFuncion();
				$parameters["qr"]=$entrada->getQr();
				$parameters["id_entrada"]=$entrada->getId();

				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters);
				return true;
			}
			catch(Exception $ex)
			{
				return false;
			}
		}
	}
?>