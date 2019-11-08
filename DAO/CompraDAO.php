<?php
	namespace DAO;

	use Models\Compra as Compra;
	use Models\Funcion as Funcion;

	class CompraDAO
	{
		private $connection;
		private $tableName = "Compras";

		public function add($compra)
		{
			try
			{
				$query = "INSERT INTO ".$this->tableName." (id_usuario, fecha_hora, precio, cantidad, descuento, total) VALUES (:id_usuario, :fecha_hora, :precio, :cantidad, :descuento, :total);";
				
				$parameters["id_usuario"]= $compra->getIdUsuario();
				$parameters["fecha_hora"]=$compra->getFechaHora();
				$parameters["precio"]=$compra->getPrecio();
				$parameters["cantidad"]=$compra->getCantidad();
				$parameters["descuento"]=$compra->getDescuento();
				$parameters["total"]=$compra->getTotal();

				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters);
			}
			catch(Exception $ex)
			{
				return null;
			}
		}		

		function remove($compra)
		{
			try
			{
				$query = "DELETE FROM ".$this->tableName." WHERE id_compra = :id_compra;";
				
				$parameters['id_compra'] = $compra->getId();
				
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters);
			}
			catch(Exception $ex)
			{
				return null;
			}
		}
		
		public function removeByUsuario($usuario)
		{
			try
			{
				$query = "DELETE FROM ".$this->tableName." WHERE id_usuario = :id_usuario;";
				
				$parameters["id_usuario"]=$usuario->getId();
				
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters);
			}
			catch(Exception $ex)
			{
				return null;
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
					$compra = new Compra();
					$compra->setId($row["id_compra"]);
					$compra->setIdUsuario($row["id_usuario"]);
					$compra->setFechaHora($row["fecha_hora"]);
					$compra->setPrecio($row["precio"]);
					$compra->setCantidad($row["cantidad"]);
					$compra->setDescuento($row["descuento"]);
					$compra->setTotal($row["total"]);
					array_push($list, $compra);
				}				
				return $list;
			}
			catch(Exception $ex)
			{
				return null;
			}
		}

		public function getCompra($compra)
		{
			try
			{
				$query = "SELECT * FROM ".$this->tableName." WHERE id_compra = ".$compra->getId().";";
				$this->connection = Connection::GetInstance();
				$resultSet = $this->connection->Execute($query);
				
				foreach ($resultSet as $row)
				{
					$compra->setId($row["id_compra"]);
					$compra->setIdUsuario($row["id_usuario"]);
					$compra->setFechaHora($row["fecha_hora"]);
					$compra->setPrecio($row["precio"]);
					$compra->setCantidad($row["cantidad"]);
					$compra->setDescuento($row["descuento"]);
					$compra->setTotal($row["total"]);
					return $compra;
				}
				return null;
			}
			catch(Exception $ex)
			{
				return null;
			}
		}

		public function getByUsuario($usuario)
		{
			try
			{
				$list = array();
				$query = "SELECT * FROM ".$this->tableName." WHERE id_usuario = ".$usuario->getId().";";
				$this->connection = Connection::GetInstance();
				$resultSet = $this->connection->Execute($query);
				
				foreach ($resultSet as $row)
				{
					$compra = new Compra();
					$compra->setId($row["id_compra"]);
					$compra->setIdUsuario($row["id_usuario"]);
					$compra->setFechaHora($row["fecha_hora"]);
					$compra->setPrecio($row["precio"]);
					$compra->setCantidad($row["cantidad"]);
					$compra->setDescuento($row["descuento"]);
					$compra->setTotal($row["total"]);
					array_push($list, $compra);
				}				
				return $list;
			}
			catch(Exception $ex)
			{
				return null;
			}
		}

		public function edit($compra)
		{
			try
			{
				$query = "UPDATE ".$this->tableName." SET id_compra = :id_compra, id_usuario = :id_usuario, fecha_hora = :fecha_hora, precio = :precio, cantidad = :cantidad, descuento = :descuento, total = :total WHERE id_compra = :id_compra;";

				$parameters["id_usuario"]=$compra->getIdUsuario();
				$parameters["fecha_hora"]=$compra->getFechaHora();
				$parameters["precio"]=$compra->getPrecio();
				$parameters["cantidad"]=$compra->getCantidad();
				$parameters["descuento"]=$compra->getDescuento();
				$parameters["total"]=$compra->getTotal();
				$parameters["id_compra"]=$compra->getId();

				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters);
			}
			catch(Exception $ex)
			{
				return null;
			}
		}
	}
?>