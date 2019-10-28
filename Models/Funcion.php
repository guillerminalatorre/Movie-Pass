<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:07:11
	 */
	namespace Models;

	class Funcion
	{
		private $id;
		private $idCine;
		private $fecha;
		private $hora;
		private $idPelicula;	

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
		 * Getter for idCine
		 *
		 * @return [type]
		 */
		public function getIdCine()
		{
			return $this->idCine;
		}

		/**
		 * Setter for idCine
		 * @var [type] idCine
		 *
		 * @return self
		 */
		public function setIdCine($idCine)
		{
			$this->idCine = $idCine;
			return $this;
		}		
	

		/**
		 * Getter for Fecha
		*
		* @return [type]
		*/
		public function getFecha()
		{
			return $this->fecha;
		}
	
		/**
		 * Setter for Fecha
		* @var [type] fecha
		*
		* @return self
		*/
		public function setFecha($fecha)
		{
			$this->fecha = $fecha;
			return $this;
		}
	
	
		/**
		 * Getter for Hora
		*
		* @return [type]
		*/
		public function getHora()
		{
			return $this->hora;
		}
	
		/**
		 * Setter for Hora
		* @var [type] hora
		*
		* @return self
		*/
		public function setHora($hora)
		{
			$this->hora = $hora;
			return $this;
		}
	
	
		/**
		 * Getter for IdPelicula
		*
		* @return [type]
		*/
		public function getIdPelicula()
		{
			return $this->idPelicula;
		}
	
		/**
		 * Setter for IdPelicula
		* @var [type] idPelicula
		*
		* @return self
		*/
		public function setIdPelicula($idPelicula)
		{
			$this->idPelicula = $idPelicula;
			return $this;
		}
	}
?>