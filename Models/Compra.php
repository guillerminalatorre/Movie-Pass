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
		private $fecha;
		private $descuento;
		private $total;
		private $id_Usuario;

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
		 * Getter for Fecha
		 *
		 * @return [type]
		 */
		public function getFecha()
		{
		    return $this->fecha;
		}

		/**
		 * Setter for Fecha
		 * @var [type] fecha
		 *
		 * @return self
		 */
		public function setFecha($fecha)
		{
		    $this->fecha = $fecha;
		    return $this;
		}

		/**
		 * Getter for Descuento
		 *
		 * @return [type]
		 */
		public function getDescuento()
		{
		    return $this->descuento;
		}

		/**
		 * Setter for Descuento
		 * @var [type] descuento
		 *
		 * @return self
		 */
		public function setDescuento($descuento)
		{
		    $this->descuento = $descuento;
		    return $this;
		}


		/**
		 * Getter for Total
		 *
		 * @return [type]
		 */
		public function getTotal()
		{
		    return $this->total;
		}

		/**
		 * Setter for Total
		 * @var [type] total
		 *
		 * @return self
		 */
		public function setTotal($total)
		{
		    $this->total = $total;
		    return $this;
		}


		/**
		 * Getter for Id_Usuario
		 *
		 * @return [type]
		 */
		public function getId_Usuario()
		{
		    return $this->id_Usuario;
		}

		/**
		 * Setter for Id_Usuario
		 * @var [type] id_Usuario
		 *
		 * @return self
		 */
		public function setId_Usuario($id_Usuario)
		{
		    $this->id_Usuario = $id_Usuario;
		    return $this;
		}
	}
?>