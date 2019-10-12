<?php
	/**
	* @author Guille
	* @version 1.0
	* @created 06-oct.-2019 19:07:11
	*/
	namespace Models;

	class Cine
	{
		private $nombre;
		private $direccion;
		private $capacidad;
		private $precio;

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