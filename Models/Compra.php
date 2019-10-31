<?php
	/**
	* @author Guille
	* @version 1.0
	* @created 06-oct.-2019 19:07:11
	*/
	namespace Models;

	class Compra
	{
		private $id;
		private $idUsuario;
		private $fechaHora;
		private $precio;
		private $cantidad;
		private $descuento;
		private $total;


		/**
		 * Get the value of id
		 */ 
		public function getId()
		{
				return $this->id;
		}

		/**
		 * Set the value of id
		 *
		 * @return  self
		 */ 
		public function setId($id)
		{
				$this->id = $id;

				return $this;
		}

		/**
		 * Get the value of idUsuario
		 */ 
		public function getIdUsuario()
		{
				return $this->idUsuario;
		}

		/**
		 * Set the value of idUsuario
		 *
		 * @return  self
		 */ 
		public function setIdUsuario($idUsuario)
		{
				$this->idUsuario = $idUsuario;

				return $this;
		}

		/**
		 * Get the value of fecha
		 */ 
		public function getFechaHora()
		{
				return $this->fechaHora;
		}

		/**
		 * Set the value of fecha
		 *
		 * @return  self
		 */ 
		public function setFechaHora($fechaHora)
		{
				$this->fechaHora = $fechaHora;

				return $this;
		}

		/**
		 * Get the value of precio
		 */ 
		public function getPrecio()
		{
				return $this->precio;
		}

		/**
		 * Set the value of precio
		 *
		 * @return  self
		 */ 
		public function setPrecio($precio)
		{
				$this->precio = $precio;

				return $this;
		}

		/**
		 * Get the value of cantidad
		 */ 
		public function getCantidad()
		{
				return $this->cantidad;
		}

		/**
		 * Set the value of cantidad
		 *
		 * @return  self
		 */ 
		public function setCantidad($cantidad)
		{
				$this->cantidad = $cantidad;

				return $this;
		}

		/**
		 * Get the value of descuento
		 */ 
		public function getDescuento()
		{
				return $this->descuento;
		}

		/**
		 * Set the value of descuento
		 *
		 * @return  self
		 */ 
		public function setDescuento($descuento)
		{
				$this->descuento = $descuento;

				return $this;
		}

		/**
		 * Get the value of total
		 */ 
		public function getTotal()
		{
				return $this->total;
		}

		/**
		 * Set the value of total
		 *
		 * @return  self
		 */ 
		public function setTotal($total)
		{
				$this->total = $total;

				return $this;
		}
	}
?>