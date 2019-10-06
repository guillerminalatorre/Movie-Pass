<?php


namespace Controllers;


/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:05:38
 */
class UsuarioController
{

	private $usuarioRepository;

	function __construct()
	{
	}

	function __destruct()
	{
	}



	/**
	 * 
	 * @param dni
	 * @param password
	 * @param email
	 * @param apellido
	 * @param rol
	 */
	public function _construct(int $dni, string $password, string $email, string $apellido, Rol $rol)
	{
	}

	public function ShowAddView()
	{
	}

	public function ShowListView()
	{
	}

	public function Add()
	{
	}

}
?>