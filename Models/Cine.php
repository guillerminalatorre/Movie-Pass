<?php
	namespace Models;

	class Cine
	{
		private $id;
		private $nombre;
		private $direccion;

		public function getNombre()
		{
			return $this->nombre;
		}

		public function getId()
		{
			return $this->id;
		}

		public function setId($id)
		{
			$this->id = $id;
			return $this;
		}

		public function setNombre($nombre)
		{
			$this->nombre = $nombre;
			return $this;
		}

		public function getDireccion()
		{
			return $this->direccion;
		}

		public function setDireccion($direccion)
		{
			$this->direccion = $direccion;
			return $this;
		}
	}
?>