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
		private $qr;
		private $id_Compra;
		private $id_Funcion;

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


		/**
		 * Getter for Id_Compra
		 *
		 * @return [type]
		 */
		public function getId_Compra()
		{
		    return $this->id_Compra;
		}

		/**
		 * Setter for Id_Compra
		 * @var [type] id_Compra
		 *
		 * @return self
		 */
		public function setId_Compra($id_Compra)
		{
		    $this->id_Compra = $id_Compra;
		    return $this;
		}


		/**
		 * Getter for Id_Funcion
		 *
		 * @return [type]
		 */
		public function getId_Funcion()
		{
		    return $this->id_Funcion;
		}

		/**
		 * Setter for Id_Funcion
		 * @var [type] id_Funcion
		 *
		 * @return self
		 */
		public function setId_Funcion($id_Funcion)
		{
		    $this->id_Funcion = $id_Funcion;
		    return $this;
		}
	}
?>