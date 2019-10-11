<?php
	/**
	* @author Guille
	* @version 1.0
	* @created 06-oct.-2019 19:07:11
	*/
	namespace Models;
	
	class Pelicula
	{
		private $id;
		private $titulo;
		private $generos;
		private $duracion;
		private $descripcion;
		private $idioma;
		private $clasificacion;
		private $actores;

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
		 * Getter for Actores
		*
		* @return [type]
		*/
		public function getActores()
		{
			return $this->actores;
		}

		/**
		 * Setter for Actores
		* @var [type] actores
		*
		* @return self
		*/
		public function setActores($actores)
		{
			$this->actores = $actores;
			return $this;
		} 

		public function agregarActor(int $id_actor)
		{
			array_push($this->actores, $id_actor); 
		}

		public function agregarGenero(int $id_genero)
		{
			array_push($this->generos, $id_genero);
		}
	}
?>