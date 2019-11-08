<?php
namespace Controllers;

use DAO\UsuarioDAO as UsuarioDAO;
use Models\Usuario as Usuario;

abstract class Administrable
{
    public function loggedIn()
	{
		return (isset($_SESSION["loggedUser"]));
	}

	public function isAdmin()
	{
		if(!isset($_SESSION["loggedUser"])) return false;
		return ($_SESSION["loggedUser"]->getId_Rol() == 2 || $_SESSION["loggedUser"]->getId_Rol() == 3);
	}

	public function isMainAdmin()
	{
		if(!isset($_SESSION["loggedUser"])) return false;
		return ($_SESSION["loggedUser"]->getId_Rol() == 3);
	}

	public function getUserRol($id_Rol)
	{
		switch($id_Rol)
		{
			case 1:
				$rol = "Usuario";
				break;
			case 2:
				$rol = "Admin";
				break;
			case 3:
				$rol = "Main Admin";
				break;
			default: 
				$rol = "Usuario";
		}
		return $rol;
	}
}
?>