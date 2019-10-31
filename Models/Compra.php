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
		private $idFuncion;
		private $fecha;
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
		 * Get the value of idFuncion
		 */ 
		public function getIdFuncion()
		{
				return $this->idFuncion;
		}

		/**
		 * Set the value of idFuncion
		 *
		 * @return  self
		 */ 
		public function setIdFuncion($idFuncion)
		{
				$this->idFuncion = $idFuncion;

				return $this;
		}

		/**
		 * Get the value of fecha
		 */ 
		public function getFecha()
		{
				return $this->fecha;
		}

		/**
		 * Set the value of fecha
		 *
		 * @return  self
		 */ 
		public function setFecha($fecha)
		{
				$this->fecha = $fecha;

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