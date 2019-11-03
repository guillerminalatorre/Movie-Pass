<?php

namespace Models;

class Pelicula
{
	private $id;
	private $idTMDB;
	private $titulo;
	private $generos;
	private $duracion;
	private $descripcion;
	private $idioma;
	private $clasificacion;
	private $fechaDeEstreno;
	private $poster;
	private $video;
	private $popularidad;

	/**
	 * Getter for Id
	 *
	 * @return [type]
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Setter for Id
	 * @var [type] id
	 *
	 * @return self
	 */
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}


	/**
	 * Getter for IdTMDB
	 *
	 * @return [type]
	 */
	public function getIdTMDB()
	{
	    return $this->idTMDB;
	}

	/**
	 * Setter for IdTMDB
	 * @var [type] idTMDB
	 *
	 * @return self
	 */
	public function setIdTMDB($idTMDB)
	{
	    $this->idTMDB = $idTMDB;
	    return $this;
	}


	/**
	 * Getter for Titulo
	 *
	 * @return [type]
	 */
	public function getTitulo()
	{
	    return $this->titulo;
	}

	/**
	 * Setter for Titulo
	 * @var [type] titulo
	 *
	 * @return self
	 */
	public function setTitulo($titulo)
	{
	    $this->titulo = $titulo;
	    return $this;
	}


	/**
	 * Getter for Generos
	 *
	 * @return [type]
	 */
	public function getGeneros()
	{
	    return $this->generos;
	}

	/**
	 * Setter for Generos
	 * @var [type] generos
	 *
	 * @return self
	 */
	public function setGeneros($generos)
	{
	    $this->generos = $generos;
	    return $this;
	}


	/**
	 * Getter for Duracion
	 *
	 * @return [type]
	 */
	public function getDuracion()
	{
	    return $this->duracion;
	}

	/**
	 * Setter for Duracion
	 * @var [type] duracion
	 *
	 * @return self
	 */
	public function setDuracion($duracion)
	{
	    $this->duracion = $duracion;
	    return $this;
	}


	/**
	 * Getter for Descripcion
	 *
	 * @return [type]
	 */
	public function getDescripcion()
	{
	    return $this->descripcion;
	}

	/**
	 * Setter for Descripcion
	 * @var [type] descripcion
	 *
	 * @return self
	 */
	public function setDescripcion($descripcion)
	{
	    $this->descripcion = $descripcion;
	    return $this;
	}


	/**
	 * Getter for Idioma
	 *
	 * @return [type]
	 */
	public function getIdioma()
	{
	    return $this->idioma;
	}

	/**
	 * Setter for Idioma
	 * @var [type] idioma
	 *
	 * @return self
	 */
	public function setIdioma($idioma)
	{
	    $this->idioma = $idioma;
	    return $this;
	}


	/**
	 * Getter for Clasificacion
	 *
	 * @return [type]
	 */
	public function getClasificacion()
	{
	    return $this->clasificacion;
	}

	/**
	 * Setter for Clasificacion
	 * @var [type] clasificacion
	 *
	 * @return self
	 */
	public function setClasificacion($clasificacion)
	{
	    $this->clasificacion = $clasificacion;
	    return $this;
	}


	/**
	 * Getter for FechaDeEstreno
	 *
	 * @return [type]
	 */
	public function getFechaDeEstreno()
	{
	    return $this->fechaDeEstreno;
	}

	/**
	 * Setter for FechaDeEstreno
	 * @var [type] fechaDeEstreno
	 *
	 * @return self
	 */
	public function setFechaDeEstreno($fechaDeEstreno)
	{
	    $this->fechaDeEstreno = $fechaDeEstreno;
	    return $this;
	}


	/**
	 * Getter for Poster
	 *
	 * @return [type]
	 */
	public function getPoster()
	{
	    return (strpos($this->poster, 'https://image.tmdb.org') === false) ? FRONT_ROOT.$this->poster : $this->poster;
	}

	/**
	 * Setter for Poster
	 * @var [type] poster
	 *
	 * @return self
	 */
	public function setPoster($poster)
	{
	    $this->poster = $poster;
	    return $this;
	}


	/**
	 * Getter for Video
	 *
	 * @return [type]
	 */
	public function getVideo()
	{
	    return $this->video;
	}

	/**
	 * Setter for Video
	 * @var [type] video
	 *
	 * @return self
	 */
	public function setVideo($video)
	{
	    $this->video = $video;
	    return $this;
	}


	/**
	 * Getter for Popularidad
	 *
	 * @return [type]
	 */
	public function getPopularidad()
	{
	    return $this->popularidad;
	}

	/**
	 * Setter for Popularidad
	 * @var [type] popularidad
	 *
	 * @return self
	 */
	public function setPopularidad($popularidad)
	{
	    $this->popularidad = $popularidad;
	    return $this;
	}
}
?>