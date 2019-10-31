<?php
	/**
	* @author Guille
	* @version 1.0
	* @created 06-oct.-2019 19:07:11
	*/
	namespace Models;
	
	class Entrada
	{
		private $id;
		private $idCompra;
		private $idFuncion;
		private $qr;

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
		 * Getter for IdCompra
		 *
		 * @return [type]
		 */
		public function getIdCompra()
		{
		    return $this->idCompra;
		}

		/**
		 * Setter for IdCompra
		 * @var [type] idCompra
		 *
		 * @return self
		 */
		public function setIdCompra($idCompra)
		{
		    $this->idCompra = $idCompra;
		    return $this;
		}

		/**
		 * Getter for IdFuncion
		 *
		 * @return [type]
		 */
		public function getIdFuncion()
		{
		    return $this->idFuncion;
		}

		/**
		 * Setter for IdFuncion
		 * @var [type] idFuncion
		 *
		 * @return self
		 */
		public function setIdFuncion($idFuncion)
		{
		    $this->idFuncion = $idFuncion;
		    return $this;
		}

		/**
		 * Getter for Qr
		 *
		 * @return [type]
		 */
		public function getQr()
		{
		    return $this->qr;
		}

		/**
		 * Setter for Qr
		 * @var [type] qr
		 *
		 * @return self
		 */
		public function setQr($qr)
		{
		    $this->qr = $qr;
		    return $this;
		}
	}
?>