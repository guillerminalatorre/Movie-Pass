<?php
	namespace Models;

	class Sala
	{
        private $id;
        private $idCine;
		private $nombre;		
        private $precio;
        private $capacidad;

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
        
		public function getNombre()
		{
            return $this->nombre;
		}

		public function setNombre($nombre)
		{
            $this->nombre = $nombre;
            return $this;
		}

        public function getPrecio()
        {
            return $this->precio;
        }

        public function setPrecio($precio)
        {
            $this->precio = $precio;
            return $this;
        }

        public function getCapacidad()
        {
            return $this->capacidad;
        }

        public function setCapacidad($capacidad)
        {
            $this->capacidad = $capacidad;
            return $this;
        }
	}
?>