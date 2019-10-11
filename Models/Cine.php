<?php
	namespace Models;

	/**
	* @author Guille
	* @version 1.0
	* @created 06-oct.-2019 19:07:11
	*/


	class Cine
	{

		private $id;
		private $nombre ;
		private $direccion ;
		private $capacidad;
		private $precio;

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
		 * Getter for Nombre
		*
		* @return [type]
		*/
		public function getNombre()
		{
			return $this->nombre;
		}

		/**
		 * Setter for Nombre
		* @var [type] nombre
		*
		* @return self
		*/
		public function setNombre($nombre)
		{
			$this->nombre = $nombre;
			return $this;
		}


		/**
		 * Getter for Direccion
		*
		* @return [type]
		*/
		public function getDireccion()
		{
			return $this->direccion;
		}

		/**
		 * Setter for Direccion
		* @var [type] direccion
		*
		* @return self
		*/
		public function setDireccion($direccion)
		{
			$this->direccion = $direccion;
			return $this;
		}


		/**
		 * Getter for Capacidad
		*
		* @return [type]
		*/
		public function getCapacidad()
		{
			return $this->capacidad;
		}

		/**
		 * Setter for Capacidad
		* @var [type] capacidad
		*
		* @return self
		*/
		public function setCapacidad($capacidad)
		{
			$this->capacidad = $capacidad;
			return $this;
		}


		/**
		 * Getter for Precio
		*
		* @return [type]
		*/
		public function getPrecio()
		{
			return $this->precio;
		}

		/**
		 * Setter for Precio
		* @var [type] precio
		*
		* @return self
		*/
		public function setPrecio($precio)
		{
			$this->precio = $precio;
			return $this;
		}
	}
?>