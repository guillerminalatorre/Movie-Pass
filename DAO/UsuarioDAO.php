<?php
require "Config/Autoload.php";

use Models\Usuario as Usuario;

namespace DAO;


/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:06:02
 */
class UsuarioDAO
{

	private $usuarioDAO;

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

		file_put_contents("Data/usuarios.json", $jsonContent);
	}

	public function RetrieveData()
	{
		$this->usuarioList = array();

		if(file_exists("Data/usuarios.json"));
		{
			$jsonContent = file_get_contents("Data/usuarios.json");

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

		if(file_exists("Data/usuarios.json"));
		{
			$jsonContent = file_get_contents("Data/usuarios.json");

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

				if($usuarioAbuscar->getDni() === $usuario->getDni())
				{
					return $usuario->getDni();
				}
				if($usuarioAbuscar->getEmail() === $usuario->getEmail())
				{
					return $usuario->getDni();
				}
			}
		}

		return 0;
	}

	/**
	 * 
	 * @param id
	 */
	public function eliminarUsuario(int $dni)
	{
		$this->usuarioList = array();

		if(file_exists("Data/usuarios.json"));
		{
			$jsonContent = file_get_contents("Data/usuarios.json");

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

				if($dni != $usuario->getDni())
				{
					array_push($this->usuarioList, $usuario);
				}
			}

			$this->SaveData();
		}
	}

}
?>