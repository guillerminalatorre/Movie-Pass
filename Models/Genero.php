<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:07:11
	 */
	namespace Models;

<<<<<<< HEAD
	class Genero
	{

		private $id;
		private $nombre;
=======
namespace Models;

/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:07:11
 */
class Genero
{

	private $id;
	private $nombre;
>>>>>>> bd20655b5c60bddde5ee21e70901550fa077abe5

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
		 * Getter for Nombre
		*
		* @return [type]
		*/
		public function getNombre()
		{
			return $this->nombre;
		}
	
		/**
		 * Setter for Nombre
		* @var [type] nombre
		*
		* @return self
		*/
		public function setNombre($nombre)
		{
			$this->nombre = $nombre;
			return $this;
		}
	}
?>