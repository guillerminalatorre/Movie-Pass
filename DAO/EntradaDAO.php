<?php
/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:06:02
 */
namespace DAO;

use Models\Entrada as Entrada;

class EntradaDAO
{
	private $connection;
	private $tableName = "Entradas";

	public function add($entrada)
		{
			try
			{
				$query = "INSERT INTO ".$this->tableName." (id_funcion, id_cine, id_pelicula, fecha, hora) VALUES (:id_funcion, :id_cine, :id_pelicula, :fecha, :hora);";
				
				$parameters["id_funcion"] = $funcion->getId();
				$parameters["id_cine"]= $funcion->getIdCine();
				$parameters["id_pelicula"]= $funcion->getIdPelicula();
				$parameters["fecha"]=$funcion->getFecha();
				$parameters["hora"]=$funcion->getHora();

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