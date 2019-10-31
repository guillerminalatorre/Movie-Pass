<?php
/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:06:02
 */
namespace DAO;

use Models\Funcion as Funcion;
use Models\Cine as Cine;

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
			$query = "INSERT INTO ".$this->tableName." (id_cine, id_pelicula, fecha_hora) VALUES (:id_cine, :id_pelicula, :fecha_hora);";
			
			$parameters["id_cine"] = $funcion->getIdCine();
			$parameters["id_pelicula"] = $funcion->getIdPelicula();
			$parameters["fecha_hora"] =$funcion->getFechaHora();

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
			$query = "DELETE FROM ".$this->tableName." WHERE id_funcion = :id_funcion;";
			
			$parameters['id_funcion'] = $funcion->getId();
			
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
				$funcion = new Funcion();
				$funcion->setId($row["id_funcion"]);
				$funcion->setIdCine($row["id_cine"]);
				$funcion->setIdPelicula($row["id_pelicula"]);
				$funcion->setFechaHora($row["fecha_hora"]);
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
			$query = "SELECT * FROM ".$this->tableName." WHERE id_funcion = ".$funcion->getId().";";
			$this->connection = Connection::GetInstance();
			$resultSet = $this->connection->Execute($query);
			
			foreach ($resultSet as $row)
			{
				$funcion->setId($row["id_funcion"]);
				$funcion->setIdCine($row["id_cine"]);
				$funcion->setIdPelicula($row["id_pelicula"]);
				$funcion->setFechaHora($row["fecha_hora"]);
				return $funcion;
			}
			return null;
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	public function getByCine($cine)
	{
		try
		{
			$list = array();
			$query = "SELECT * FROM ".$this->tableName." WHERE id_cine = ".$cine->getId().";";
			$this->connection = Connection::GetInstance();
			$resultSet = $this->connection->Execute($query);
			
			foreach ($resultSet as $row)
			{
				$funcion = new Funcion();
				$funcion->setId($row["id_funcion"]);
				$funcion->setIdCine($row["id_cine"]);
				$funcion->setIdPelicula($row["id_pelicula"]);
				$funcion->setFechaHora($row["fecha_hora"]);
				array_push($list, $funcion);
			}				
			return $list;
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	
	public function getByPelicula($pelicula)
	{
		try
		{
			$list = array();
			$query = "SELECT * FROM ".$this->tableName." WHERE id_pelicula = ".$pelicula->getId().";";
			$this->connection = Connection::GetInstance();
			$resultSet = $this->connection->Execute($query);
			
			foreach ($resultSet as $row)
			{
				$funcion = new Funcion();
				$funcion->setId($row["id_funcion"]);
				$funcion->setIdCine($row["id_cine"]);
				$funcion->setIdPelicula($row["id_pelicula"]);
				$funcion->setFechaHora($row["fecha_hora"]);
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
			$query = "UPDATE ".$this->tableName." SET id_cine = :id_cine, id_pelicula = :id_pelicula, fecha_hora = :fecha_hora WHERE id_funcion = :id_funcion;";

			$parameters["id_cine"]= $funcion->getIdCine();
			$parameters["id_pelicula"]= $funcion->getIdPelicula();
			$parameters["fecha_hora"]=$funcion->getFechaHora();
			$parameters["id_funcion"]=$funcion->getId();

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