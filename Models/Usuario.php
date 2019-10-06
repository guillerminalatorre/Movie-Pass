<?php
require_once ('Rol.php');

namespace Models;



use Models;
/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:07:11
 */
class Usuario
{

	private $dni;
	private $password;
	private $email;
	private $apellido;
	private $nombre;
	private $rol;
	public $m_Rol;

	function __construct()
	{
	}

	function __destruct()
	{
	}



}
?>