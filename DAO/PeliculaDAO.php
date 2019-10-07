<?php
require "Config/Autoload.php";
use Models\Pelicula as Pelicula;
use Models\Genero as Genero;

namespace DAO;


/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:06:02
 */
class PeliculaDAO
{

	private $peliculaList = array;

	/**
	 * 
	 * @param pelicula
	 */
	public function add(Pelicula $pelicula)
	{
		$this->RetrieveData();
	
		array_push($this->peliculaList, $pelicula);
	
		$this->SaveData();
	}

	public function getAll()
	{
		$this->Retrievedata();
	
		return $this->peliculaList;
	}

	public function SaveData()
	{
		$arrayToEncode = array();

		foreach($this->peliculaList as $pelicula)
		{
			$valuesArray["id"] = $pelicula->getId();
			$valuesArray["titulo"]= $pelicula->getTitulo();
			$valuesArray["generos"]= $pelicula->getGeneros();
			$valuesArray["duracion"]=$pelicula->getDuracion();
			$valuesArray["descripcion"]=$pelicula->getDescripcion();
			$valuesArray["idioma"]=$pelicula->getIdioma();
			$valuesArray["clasificacion"]=$pelicula->getClasificacion();
			$valuesArray["actores"]=$pelicula->getActores();
			
		
			array_push($arrayToEncode, $valuesArray);
		}

		$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

		file_put_contents("Data/peliculas.json", $jsonContent);
	}

	public function RetrieveData()
	{
		$this->peliculaList = array();

		if(file_exists("Data/peliculas.json"));
		{
			$jsonContent = file_get_contents("Data/peliculas.json");

			$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
			
			foreach($arrayToDecode as $valuesArray)
			{
				$pelicula = new Pelicula();
				$pelicula->setId($valuesArray["id"] );
				$pelicula->setTitulo($valuesArray["titulo"] );
				$pelicula->setGeneros($valuesArray["generos"] );
				$pelicula->setDuracion($valuesArray["duracion"]);
				$pelicula->setDescripcion($valuesArray["descripcion"]);
				$pelicula->setIdioma($valuesArray["idioma"]);
				$pelicula->setClasificacion($valuesArray["clasificacion"]);
				$pelicula->setActores($valuesArray["actores"]);

				array_push($this->peliculaList, $pelicula);
			}
		}
	}

	/**
	 * retorna 0 si no existe, la id si existe
	 * 
	 * @param peliculaAbuscar busca por id, por titulo y por fecha.
	 */
	public function peliculaExists(Pelicula $peliculaAbuscar)
	{
		$this->peliculaList = array();

		if(file_exists("Data/peliculas.json"));
		{
			$jsonContent = file_get_contents("Data/peliculas.json");

			$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
			
			foreach($arrayToDecode as $valuesArray)
			{
				$pelicula = new Pelicula();
				$pelicula->setId($valuesArray["id"] );
				$pelicula->setTitulo($valuesArray["titulo"] );
				$pelicula->setGeneros($valuesArray["generos"] );
				$pelicula->setDuracion($valuesArray["duracion"]);
				$pelicula->setDescripcion($valuesArray["descripcion"]);
				$pelicula->setIdioma($valuesArray["idioma"]);
				$pelicula->setClasificacion($valuesArray["clasificacion"]);
				$pelicula->setActores($valuesArray["actores"]);

				if($peliculaAbuscar->getId() === $pelicula->getId())
				{
					return $pelicula->getId();
				}

				if($peliculaAbuscar->getTitulo() === $pelicula->getTitulo())
				{
					return $pelicula->getId();
				}
				if($peliculaAbuscar->getFecha() === $pelicula->getFecha())
				{
					return $pelicula->getId();
				}
			}
		}	
		return 0;
	}

	public function getPelicula(int $id)
	{
		$this->peliculaList = array();

		if(file_exists("Data/peliculas.json"));
		{
			$jsonContent = file_get_contents("Data/peliculas.json");

			$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
			
			foreach($arrayToDecode as $valuesArray)
			{
				$pelicula = new Pelicula();
				$pelicula->setId($valuesArray["id"] );
				$pelicula->setTitulo($valuesArray["titulo"] );
				$pelicula->setGeneros($valuesArray["generos"] );
				$pelicula->setDuracion($valuesArray["duracion"]);
				$pelicula->setDescripcion($valuesArray["descripcion"]);
				$pelicula->setIdioma($valuesArray["idioma"]);
				$pelicula->setClasificacion($valuesArray["clasificacion"]);
				$pelicula->setActores($valuesArray["actores"]);

				if($pelicula->getId() === $id)
				{
					return $pelicula;
				}
			}
		}	
		return null;
	}

	public function peliculasXGenero(string $genero)
	{
		$this->peliculaList = array();

		$busqueda = array();

		if(file_exists("Data/peliculas.json"));
		{
			$jsonContent = file_get_contents("Data/peliculas.json");

			$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
			
			foreach($arrayToDecode as $valuesArray)
			{
				$pelicula = new Pelicula();
				$pelicula->setId($valuesArray["id"] );
				$pelicula->setTitulo($valuesArray["titulo"] );
				$pelicula->setGeneros($valuesArray["generos"] );
				$pelicula->setDuracion($valuesArray["duracion"]);
				$pelicula->setDescripcion($valuesArray["descripcion"]);
				$pelicula->setIdioma($valuesArray["idioma"]);
				$pelicula->setClasificacion($valuesArray["clasificacion"]);
				$pelicula->setActores($valuesArray["actores"]);

				$generos = array();
				$generos = $pelicula->getGeneros();

				for($generos as $gen)
				{
					if($gen === $genero)
					{
						array_push($busqueda, $pelicula);
					}
				}
			}
		}	
		return $busqueda;
	}

	/**
	 * 
	 * @param id
	 */
	public function eliminarPelicula(int $id)
	{
		$this->peliculaList = array();

		if(file_exists("Data/peliculas.json"));
		{
			$jsonContent = file_get_contents("Data/peliculas.json");

			$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
			
			foreach($arrayToDecode as $valuesArray)
			{
				$pelicula = new Pelicula();
				$pelicula->setId($valuesArray["id"] );
				$pelicula->setTitulo($valuesArray["titulo"] );
				$pelicula->setGeneros($valuesArray["generos"] );
				$pelicula->setDuracion($valuesArray["duracion"]);
				$pelicula->setDescripcion($valuesArray["descripcion"]);
				$pelicula->setIdioma($valuesArray["idioma"]);
				$pelicula->setClasificacion($valuesArray["clasificacion"]);
				$pelicula->setActores($valuesArray["actores"]);

				if($id != $pelicula->getId())
				{
					array_push($this->peliculaList, $pelicula);
				}
			}

			$this->SaveData();
	}

}
?>