<?php

namespace DAO;

use \Exception as Exception;
use Models\Pelicula as Pelicula;
use Models\Genero as Genero;
use DAO\Connection as Connection;

class PeliculaDAO
{
	private $connection;
	private $tableName = "Peliculas";

	public function getAll()
	{
		try {
			$list = array();
			$query = "SELECT * FROM " . $this->tableName;
			$this->connection = Connection::GetInstance();
			$resultSet = $this->connection->Execute($query);

			foreach ($resultSet as $row) {
				$pelicula = new Pelicula();
				$pelicula->setIdTMDB($row["id_TMDB"]);
				$pelicula->setTitulo($row["titulo"]);
				//$pelicula->agregarGenero($genero);
				$pelicula->setDuracion($row["duracion"]);
				$pelicula->setDescripcion($row["descripcion"]);
				$pelicula->setIdioma($row["idioma"]);
				$pelicula->setClasificacion($row["clasificacion"]);
				$pelicula->setFechaDeEstreno($row["fechaDeEstreno"]);
				$pelicula->setPoster($row["poster"]);
				$pelicula->setVideo($row["video"]);
				$pelicula->setPopularidad($row["popularidad"]);

				array_push($list, $pelicula);
			}

			return $list;
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	public function add($pelicula)
	{
		try {
			$query = "INSERT INTO " . $this->tableName . " (id_TMDB, titulo, duracion, descripcion, idioma, clasificacion, fechaDeEstreno, poster, video, popularidad) VALUES (:id_TMDB, :titulo, :duracion, :descripcion, :idioma, :clasificacion, :fechaDeEstreno, :poster, :video, :popularidad);";
			$parameters["id_TMDB"] = $pelicula->getIdTMDB();
			$parameters["titulo"] = $pelicula->getTitulo();
			$parameters["duracion"] = $pelicula->getDuracion();
			$parameters["descripcion"] = $pelicula->getDescripcion();
			$parameters["idioma"] = $pelicula->getIdioma();
			$parameters["clasificacion"] = $pelicula->getClasificacion();
			$parameters["fechaDeEstreno"] = $pelicula->getFechaDeEstreno();
			$parameters["poster"] = $pelicula->getPoster();
			$parameters["video"] = $pelicula->getVideo();
			$parameters["popularidad"] = $pelicula->getPopularidad();

			$this->connection = Connection::GetInstance();
			$this->connection->ExecuteNonQuery($query, $parameters);
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function remove($pelicula)
	{
		try {
			$query = "DELETE FROM " . $this->tableName . " WHERE id_pelicula = " . $pelicula->getId() . ";";

			$this->connection = Connection::GetInstance();
			$this->connection->ExecuteNonQuery($query);
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	public function getPelicula($pelicula)
	{
		try {
			$query = "SELECT * FROM " . $this->tableName . "WHERE id_pelicula = " . $pelicula->getId() . ";";
			$this->connection = Connection::GetInstance();
			$resultSet = $this->connection->Execute($query);

			foreach ($resultSet as $row) {
				$result = new Pelicula();
				$result->setIdTMDB($row["id_TMDB"]);
				$result->setTitulo($row["titulo"]);
				//$pelicula->agregarGenero($genero);
				$result->setDuracion($row["duracion"]);
				$result->setDescripcion($row["descripcion"]);
				$result->setIdioma($row["idioma"]);
				$result->setClasificacion($row["clasificacion"]);
				$result->setFechaDeEstreno($row["fechaDeEstreno"]);
				$result->setPoster($row["poster"]);
				$result->setVideo($row["video"]);
				$result->setPopularidad($row["popularidad"]);
			}
			return $result;
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	public function getFilteredMovies($id, $fecha)
	{
		//TODO: IMPLEMENTAR METODO QUE FILTRE LAS FUNCIONES			
		return array();
	}
}

?>