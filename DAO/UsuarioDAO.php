<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:06:02
	 */
	namespace DAO;

	use Models\Usuario as Usuario;

	class UsuarioDAO
	{
		private $usuarioList = array();
		private $fileName = ROOT."Data/usuarios.json";

		/**
		 * 
		 * @param usuario
		 */
		public function add(Usuario $usuario)
		{
			$this->retrieveData();

			array_push($this->usuarioList, $usuario);
				
			$this->saveData();
		}

		public function getAll()
		{
			$this->Retrievedata();

			return $this->usuarioList;
		}

		public function SaveData()
		{
			$arrayToEncode = array();

			foreach($this->usuarioList as $usuario)
			{
				$valuesArray["dni"] = $usuario->getDni();
				$valuesArray["password"]= $usuario->getPassword();
				$valuesArray["email"]= $usuario->getEmail();
				$valuesArray["apellido"]=$usuario->getApellido();
				$valuesArray["nombre"]=$usuario->getNombre();
				$valuesArray["id_Rol"]=$usuario->getId_Rol();
			
				array_push($arrayToEncode, $valuesArray);
			}

			$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

			file_put_contents($fileName, $jsonContent);
		}

		public function RetrieveData()
		{
			$this->usuarioList = array();

			if(file_exists($fileName));
			{
				$jsonContent = file_get_contents($fileName);

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$usuario = new Usuario();
					$usuario->setDni($valuesArray["dni"]);
					$usuario->setPassword($valuesArray["password"]);
					$usuario->setEmail($valuesArray["email"]);
					$usuario->setApellido($valuesArray["apellido"]);
					$usuario->setNombre($valuesArray["nombre"]);
					$usuario->setId_Rol($valuesArray["id_Rol"]);

					array_push($this->usuarioList, $usuario);
				}
			}
		}

		/**
		 * retorna 0 si no existe, la id si existe
		 * @param usuario buscar por dni y por email
		 */
		public function usuarioExists(Usuario $usuario)
		{
			$this->usuarioList = array();

			if(file_exists($fileName));
			{
				$jsonContent = file_get_contents($fileName);

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$usuario = new Usuario();
					$usuario->setDni($valuesArray["dni"]);
					$usuario->setPassword($valuesArray["password"]);
					$usuario->setEmail($valuesArray["email"]);
					$usuario->setApellido($valuesArray["apellido"]);
					$usuario->setNombre($valuesArray["nombre"]);
					$usuario->setId_Rol($valuesArray["id_Rol"]);

					if($usuarioAbuscar->getDni() === $usuario->getDni() || $usuarioAbuscar->getEmail() === $usuario->getEmail())
					{
						return $usuario;
					}
				}
			}
			return 0;
		}
		
		public function GetByEmail($email)
        {
            $user = null;

            $this->RetrieveData();

            $users = array_filter($this->userList, function($user) use($email){
                return $user->getEmail() == $email;
            });

            $users = array_values($users); //Reordering array indexes

            return (count($users) > 0) ? $users[0] : null;
		}
		
		public function GetByDni($dni)
        {
            $user = null;

            $this->RetrieveData();

            $users = array_filter($this->userList, function($user) use($dni){
                return $user->getDni() == $dni;
            });

            $users = array_values($users); //Reordering array indexes

            return (count($users) > 0) ? $users[0] : null;
        }

		/**
		 * 
		 * @param email
		 */
		public function eliminarUsuario($email)
		{
			$this->usuarioList = array();

			if(file_exists($fileName));
			{				
				$jsonContent = file_get_contents($fileName);

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$usuario = new Usuario();
					$usuario->setDni($valuesArray["dni"]);
					$usuario->setPassword($valuesArray["password"]);
					$usuario->setEmail($valuesArray["email"]);
					$usuario->setApellido($valuesArray["apellido"]);
					$usuario->setNombre($valuesArray["nombre"]);
					$usuario->setId_Rol($valuesArray["id_Rol"]);

					if($email != $usuario->getEmail())
					{
						array_push($this->usuarioList, $email);
					}
				}
				$this->SaveData();
			}
		}
	}
?>