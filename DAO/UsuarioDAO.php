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

		function remove($email)
        {
            $this->RetrieveData();

            $this->usuarioList = array_filter($this->usuarioList, function($usuario) use($email){
                return $usuario->getEmail() != $email;
            });

            $this->SaveData();
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
				$valuesArray["ip"]=$usuario->getIp();
				$valuesArray["registerDate"]=$usuario->getRegisterDate();
				$valuesArray["lastConnection"]=$usuario->getLastConnection();
				$valuesArray["loggedIn"]=$usuario->getLoggedIn();
				$valuesArray["image"]=$usuario->getImage();
			
				array_push($arrayToEncode, $valuesArray);
			}

			$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

			$jsonPath = $this->GetJsonFilePath(); //Get correct json path

			file_put_contents($jsonPath, $jsonContent);
		}

		public function RetrieveData()
		{
			$this->usuarioList = array();

			$jsonPath = $this->GetJsonFilePath(); //Get correct json path

			if(file_exists($jsonPath));
			{
				$jsonContent = file_get_contents($jsonPath);

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
					$usuario->setIp($valuesArray["ip"]);
					$usuario->setRegisterDate($valuesArray["registerDate"]);
					$usuario->setLastConnection($valuesArray["lastConnection"]);
					$usuario->setLoggedIn($valuesArray["loggedIn"]);
					$usuario->setImage($valuesArray["image"]);

					array_push($this->usuarioList, $usuario);
				}
			}
		}
		
		public function GetByEmail($email)
        {
            $user = null;

            $this->RetrieveData();

            $users = array_filter($this->usuarioList, function($user) use($email){
                return $user->getEmail() == $email;
            });

            $users = array_values($users); //Reordering array indexes

            return (count($users) > 0) ? $users[0] : null;
		}
		
		public function GetByDni($dni)
        {
            $user = null;

            $this->RetrieveData();

            $users = array_filter($this->usuarioList, function($user) use($dni){
                return $user->getDni() == $dni;
            });

            $users = array_values($users); //Reordering array indexes

            return (count($users) > 0) ? $users[0] : null;
        }

		//Need this function to return correct file json path
		function GetJsonFilePath(){

			$initialPath = "Data\usuarios.json";
			
			if(file_exists($initialPath)){
				$jsonFilePath = $initialPath;
			}else{
				$jsonFilePath = ROOT.$initialPath;
			}
			
			return $jsonFilePath;
		}
	}
?>