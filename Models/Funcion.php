<?php
	namespace Models;

	class Funcion
	{
		private $id;
		private $idCine;
		private $idSala;
		private $fechaHora;
		private $idPelicula;	

		public function getId()
		{
			return $this->id;
		}

		public function setId($id)
		{
			$this->id = $id;
			return $this;
		}

		public function getIdCine()
		{
			return $this->idCine;
		}

		public function setIdCine($idCine)
		{
			$this->idCine = $idCine;
			return $this;
		}	

		public function getIdSala()
		{
			return $this->idSala;
		}

		public function setIdSala($idSala)
		{
			$this->idSala = $idSala;
			return $this;
		}	
		
		public function getIdPelicula()
		{
			return $this->idPelicula;
		}
	
		public function setIdPelicula($idPelicula)
		{
			$this->idPelicula = $idPelicula;
			return $this;
		}

		public function getFechaHora()
		{
			return $this->fechaHora;
		}

		public function setFechaHora($fechaHora)
		{
			$this->fechaHora = $fechaHora;
			return $this;
		}

		public function getFecha(){
			$timestamp = $this->getFechaHora();
			$datetime = explode(" ",$timestamp);
			return $datetime[0];
		}

		public function getHora(){
			$timestamp = $this->getFechaHora();
			$datetime = explode(" ",$timestamp);
			return $datetime[1];	
		}
	}
?>