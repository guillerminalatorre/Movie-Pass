<?php

	namespace Models;

	/**
	* @author Guille
	* @version 1.0
	* @created 06-oct.-2019 19:07:11
	*/
	class Compra
	{

		private $id;
		private $fecha;
		private $cantEntradas;
		private $descuento;
		private $total;
		private $id_Usuario;

		function __construct(int $id, string $fecha, int $cantEntradas, int $descuento, float $total, int $id_Usuario )
		{
			$this->id = $id;
			$this->fecha = $fecha;
			$this->cantEntradas = $cantEntradas;
			$this->logicaDescuento();
			$this->total = $total;
			$this->id_Usuario = $id_Usuario;
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
		 * Getter for CantEntradas
		 *
		 * @return [type]
		 */
		public function getCantEntradas()
		{
		    return $this->cantEntradas;
		}

		/**
		 * Setter for CantEntradas
		 * @var [type] cantEntradas
		 *
		 * @return self
		 */
		public function setCantEntradas($cantEntradas)
		{
		    $this->cantEntradas = $cantEntradas;
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


		private function logicaDescuento()
		{
			date_default_timezone_get();

			$diaActual = date("D");

			if($diaActual == "Tue" || $diaActual == "Wed")
			{
				if($this->cantEntradas >1) 
				{
					$this->setDescuento(25);
				}
				else {
					$this->setDescuento(0);
				}
			}
			else {
				$this->setDescuento(0);
			}
		}

	}
?>