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
		private $nombre = null;
		private $direccion = null;
		private $capacidad;
		private $precio;

		function __constructor(int $id, string $nombre, string $direccion, int $capacidad, float $precio)
		{
			$this->id=$id;
			$this->nombre = $nombre;
			$this->direccion = $direccion;
			$this->capacidad=$capacidad;
			$this->precio = $precio;
		}

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
		* Getter for Nombre = null
		*
		* @return [type]
		*/
		public function getNombre = null()
		{
			return $this->nombre = null;
		}

		/**
		* Setter for Nombre = null
		* @var [type] nombre = null
		*
		* @return self
		*/
		public function setNombre = null($nombre = null)
		{
			$this->nombre = null = $nombre = null;
			return $this;
		}


		/**
		* Getter for Direccion = null
		*
		* @return [type]
		*/
		public function getDireccion = null()
		{
			return $this->direccion = null;
		}

		/**
		* Setter for Direccion = null
		* @var [type] direccion = null
		*
		* @return self
		*/
		public function setDireccion = null($direccion = null)
		{
			$this->direccion = null = $direccion = null;
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