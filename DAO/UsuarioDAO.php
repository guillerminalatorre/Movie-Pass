<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:06:02
	 */
	namespace DAO;

	use \Exception as Exception;
	use Models\Usuario as Usuario;
    use DAO\Connection as Connection;

	class UsuarioDAO
	{
		private $connection;
        private $tableName = "Usuarios";

		/**
		 * 
		 * @param usuario
		 */
		public function add($usuario)
		{
			try
            {
                $query = "INSERT INTO ".$this->tableName." (id_usuario, dni, contraseña, email, apellido, nombre, rol, ip, registerDate, lastConnection, loggedIn, image, facebookId) VALUES (:id_usuario, :dni, :contraseña, :email, :apellido, :nombre, :rol, :ip, :registerDate, :lastConnection, :loggedIn, :image, :facebookId);";
				
				$parameters["id_usuario"] = $usuario->getId();
                $parameters["dni"] = $usuario->getDni();
				$parameters["contraseña"]= $usuario->getPassword();
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
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
		}

		function remove($usuario)
        {
			try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE id_usuario = ".$usuario->getId().";";
                
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
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
					$usuario->setPassword($row["contraseña"]);
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
                throw $ex;
            }
		}
		
		public function getUsuario($usuario)
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE id = ".$usuario->getId().";";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {
					$usuario->setId($row["id_usuario"]);
					$usuario->setDni($row["dni"]);
					$usuario->setPassword($row["contraseña"]);
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
				return null;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
		}

		public function getByEmail($email)
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE email = ".$email.";";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {
					$usuario = new Usuario();
					$usuario->setId($row["id_usuario"]);
					$usuario->setDni($row["dni"]);
					$usuario->setPassword($row["contraseña"]);
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
				return null;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
		}

		public function edit($usuario)
		{
			try
            {
				$query = "UPDATE ".$this->tableName." SET dni = :dni, contraseña = :contraseña, email = :email, apellido = :apellido, nombre = :nombre, rol = :rol, ip = :ip, registerDate = :registerDate, lastConnection = :lastConnection, loggedIn = :loggedIn, image = :image, facebookId = :facebookId WHERE id_usuario =".$usuario->getId().";";

				$parameters["dni"]=$usuario->getDni();
				$parameters["contraseña"]= $usuario->getPassword();
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
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
		}
	}
?>