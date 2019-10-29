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
		private $fechaHora;
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
		
		/**
		* Getter for FechaHora
		*
		* @return [type]
		*/
		public function getFechaHora()
		{
			return $this->fechaHora;
		}

		/**
		* Setter for FechaHora
		* @var [type] fechaHora
		*
		* @return self
		*/
		public function setFechaHora($fechaHora)
		{
			$this->fechaHora = $fechaHora;
			return $this;
		}

	}
?>