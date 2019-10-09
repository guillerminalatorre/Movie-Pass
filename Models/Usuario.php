<?php
	/**
	* @author Guille
	* @version 1.0
	* @created 06-oct.-2019 19:07:11
	*/
	namespace Models;
	
	class Usuario
	{

		private $dni;
		private $password;
		private $email;
		private $apellido;
		private $nombre;
		private $id_Rol;

		/**
		 * Getter for Dni
		 *
		 * @return [type]
		 */
		public function getDni()
		{
			return $this->dni;
		}
 
		/**
		 * Setter for Dni
		* @var [type] dni
		*
		* @return self
		*/
		public function setDni($dni)
		{
			$this->dni = $dni;
			return $this;
		}


		/**
		 * Getter for Password
		*
		* @return [type]
		*/
		public function getPassword()
		{
			return $this->password;
		}

		/**
		 * Setter for Password
		* @var [type] password
		*
		* @return self
		*/
		public function setPassword($password)
		{
			$this->password = $password;
			return $this;
		}


		/**
		 * Getter for Email
		*
		* @return [type]
		*/
		public function getEmail()
		{
			return $this->email;
		}

		/**
		 * Setter for Email
		* @var [type] email
		*
		* @return self
		*/
		public function setEmail($email)
		{
			$this->email = $email;
			return $this;
		}


		/**
		 * Getter for Apellido
		*
		* @return [type]
		*/
		public function getApellido()
		{
			return $this->apellido;
		}

		/**
		 * Setter for Apellido
		* @var [type] apellido
		*
		* @return self
		*/
		public function setApellido($apellido)
		{
			$this->apellido = $apellido;
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


		/**
		 * Getter for Id_Rol
		*
		* @return [type]
		*/
		public function getId_Rol()
		{
			return $this->id_Rol;
		}

		/**
		 * Setter for Id_Rol
		* @var [type] id_Rol
		*
		* @return self
		*/
		public function setId_Rol($id_Rol)
		{
			$this->id_Rol = $id_Rol;
			return $this;
		}
	}
?>