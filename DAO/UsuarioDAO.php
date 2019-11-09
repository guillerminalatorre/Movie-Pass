<?php
	namespace DAO;

	use \Exception as Exception;
	use Models\Usuario as Usuario;
    use DAO\Connection as Connection;

	class UsuarioDAO
	{
		private $connection;
        private $tableName = "Usuarios";

		public function add($usuario)
		{
			try
            {
                $query = "INSERT INTO ".$this->tableName." (id_usuario, dni, password, email, apellido, nombre, rol, ip, registerDate, lastConnection, loggedIn, image, facebookId) VALUES (:id_usuario, :dni, :password, :email, :apellido, :nombre, :rol, :ip, :registerDate, :lastConnection, :loggedIn, :image, :facebookId);";
				
				$parameters["id_usuario"] = $usuario->getId();
                $parameters["dni"] = $usuario->getDni();
				$parameters["password"]= $usuario->getPassword();
				$parameters["email"]= $usuario->getEmail();
				$parameters["apellido"]=$usuario->getApellido();
				$parameters["nombre"]=$usuario->getNombre();
				$parameters["rol"]=$usuario->getId_Rol();
				$parameters["ip"]=$usuario->getIp();
				$parameters["registerDate"]=$usuario->getRegisterDate();
				$parameters["lastConnection"]=$usuario->getLastConnection();
				$parameters["loggedIn"]=$usuario->getLoggedIn();
				$parameters["image"]=$usuario->getImage();
				$parameters["facebookId"]=$usuario->getFacebookId();
                $this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters);
				return true;
            }
            catch(Exception $ex)
            {
                return false;
            }
		}

		function remove($usuario)
        {
			try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE id_usuario = :id_usuario;";
				
				$parameters["id_usuario"] = $usuario->getId();

                $this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters);
				return true;
            }
            catch(Exception $ex)
            {
                return false;
            }
        }

		public function getAll()
		{
			try
            {
                $list = array();
                $query = "SELECT * FROM ".$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {
					$usuario = new Usuario();
					$usuario->setId($row["id_usuario"]);
					$usuario->setDni($row["dni"]);
					$usuario->setPassword($row["password"]);
					$usuario->setEmail($row["email"]);
					$usuario->setApellido($row["apellido"]);
					$usuario->setNombre($row["nombre"]);
					$usuario->setId_Rol($row["rol"]);
					$usuario->setIp($row["ip"]);
					$usuario->setRegisterDate($row["registerDate"]);
					$usuario->setLastConnection($row["lastConnection"]);
					$usuario->setLoggedIn($row["loggedIn"]);
					$usuario->setImage($row["image"]);
					$usuario->setFacebookId($row["facebookId"]);
                    array_push($list, $usuario);
				}
                return $list;
            }
            catch(Exception $ex)
            {
                return null;
            }
		}
		
		public function getUsuario($usuario)
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE id_usuario = ".$usuario->getId().";";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {
					$usuario->setId($row["id_usuario"]);
					$usuario->setDni($row["dni"]);
					$usuario->setPassword($row["password"]);
					$usuario->setEmail($row["email"]);
					$usuario->setApellido($row["apellido"]);
					$usuario->setNombre($row["nombre"]);
					$usuario->setId_Rol($row["rol"]);
					$usuario->setIp($row["ip"]);
					$usuario->setRegisterDate($row["registerDate"]);
					$usuario->setLastConnection($row["lastConnection"]);
					$usuario->setLoggedIn($row["loggedIn"]);
					$usuario->setImage($row["image"]);
					$usuario->setFacebookId($row["facebookId"]);
                    return $usuario;
				}
            }
            catch(Exception $ex)
            {
                return null;
            }
		}

		public function getByEmail($email)
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE email = '".$email."';";
                $this->connection = Connection::GetInstance();
				$resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {
					$usuario = new Usuario();
					$usuario->setId($row["id_usuario"]);
					$usuario->setDni($row["dni"]);
					$usuario->setPassword($row["password"]);
					$usuario->setEmail($row["email"]);
					$usuario->setApellido($row["apellido"]);
					$usuario->setNombre($row["nombre"]);
					$usuario->setId_Rol($row["rol"]);
					$usuario->setIp($row["ip"]);
					$usuario->setRegisterDate($row["registerDate"]);
					$usuario->setLastConnection($row["lastConnection"]);
					$usuario->setLoggedIn($row["loggedIn"]);
					$usuario->setImage($row["image"]);
					$usuario->setFacebookId($row["facebookId"]);
                    return $usuario;
				}
            }
            catch(Exception $ex)
            {
                return null;
            }
		}

		public function edit($usuario)
		{
			try
            {
				$query = "UPDATE ".$this->tableName." SET dni = :dni, password = :password, email = :email, apellido = :apellido, nombre = :nombre, rol = :rol, ip = :ip, registerDate = :registerDate, lastConnection = :lastConnection, loggedIn = :loggedIn, image = :image, facebookId = :facebookId WHERE id_usuario = :id_usuario;";

				$parameters["dni"]=$usuario->getDni();
				$parameters["password"]= $usuario->getPassword();
				$parameters["email"]= $usuario->getEmail();
				$parameters["apellido"]=$usuario->getApellido();
				$parameters["nombre"]=$usuario->getNombre();
				$parameters["rol"]=$usuario->getId_Rol();
				$parameters["ip"]=$usuario->getIp();
				$parameters["registerDate"]=$usuario->getRegisterDate();
				$parameters["lastConnection"]=$usuario->getLastConnection();
				$parameters["loggedIn"]=$usuario->getLoggedIn();
				$parameters["image"]=$usuario->getImage(true);
				$parameters["facebookId"]=$usuario->getFacebookId();
				$parameters["id_usuario"]=$usuario->getId();

				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters);
				return true;
            }
            catch(Exception $ex)
            {
                return false;
            }
		}
	}
?>