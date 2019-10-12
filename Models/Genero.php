<?php
	namespace Models;

	class Genero
	{
		private $id;
		private $nombre;

		public function getId()
		{
			return $this->id;
		}
	
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
	
		public function setNombre($nombre)
		{
			$this->nombre = $nombre;
			return $this;
		}
	}
?>